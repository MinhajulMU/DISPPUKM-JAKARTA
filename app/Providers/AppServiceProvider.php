<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
        $this->registerAllRepositories();
        // register services
        $this->registerAllServices();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }

    private function registerAllRepositories()
    {
        $this->iterator('Repository', $this->app->basePath('app/Repositories'));
    }

    /**
     * Register all services
     *
     * @return void
     */
    private function registerAllServices()
    {
        $this->iterator('Service', $this->app->basePath('app/Services'));
    }

    public function iterator(string $type, string|\SplFileInfo $item)
    {
        $path = $item instanceof \SplFileInfo ? $item->getPathname() : $item;
        // validate dir path
        if (is_dir($path)) {
            // create iterator
            $iterator = new RecursiveDirectoryIterator($path);
            // loop the iterator
            foreach ($iterator as $item) {
                /**
                 * @var \SplFileInfo $item
                 */
                // validate item
                if (in_array($item->getFilename(), ['.', '..'])) {
                    continue;
                }
                // skip file
                if ($item->isFile()) {
                    continue;
                }
                // if current item is dir
                if ($item->isDir()) {
                    $this->findAndRegister($type, $item);
                }
            }
        }
    }

    /**
     * Find class and register it
     *
     * @param string $type
     * @param string|\SplFileInfo $item
     * @return void
     */
    public function findAndRegister(string $type, string|\SplFileInfo $item)
    {
        // define item variable
        $fileName = $item->getFilename();
        $pathName = $item->getPathname();
        // define object name
        $className = $fileName . $type;
        $interfaceName = $fileName . $type . 'Interface';
        // validate file exists
        if (
            file_exists(sprintf('%s/%s.php', $pathName, $className))
            && file_exists(sprintf('%s/%s.php', $pathName, $interfaceName))
        ) {
            $nsp = str_replace([$this->app->basePath('app/'), '/'], ['', '\\'], $pathName);
            $nspClass = sprintf("App\\%s\\%s", $nsp, $className);
            $nspInterface = sprintf("App\\%s\\%s", $nsp, $interfaceName);
            // register to the app
            $this->app->singleton($nspInterface, $nspClass);
        } else {
            // otherwise iterate current path
            $this->iterator($type, $item);
        }
    }
}
