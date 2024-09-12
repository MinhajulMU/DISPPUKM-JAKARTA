<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPKUM Jakarta - Feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="text-center mt-5">
            <img src="/images/logo_ppkukm.png" width="200" class="text-center mx-auto">
        </div>
        <h1 class="text-center mt-5">DINAS PPUKM</h1>
        <div class="text-center">
            <h3>{{ $data->channel->title}}</h3>
            <h4>{{ $data->channel->description}}</h4>
        </div>
        <div class="row w-full">        
        <?php
        if (count($data->channel->item) == 0) {
            ?>
            Empty Data
            <?php
        }else{
        foreach ($data->channel->item as $key => $value) {
            ?>

                <div class="col-sm mt-2">
                    <div class="card" style="width: 18rem;">
                        {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                        <div class="card-body">
                          <h5 class="card-title">{{ $value->title }} </h5>
                          <p></p>
                          <?php
                        //    echo (string) $value->description;
                          ?>
                          <p class="card-text">{{ $value->pubDate }} </p>
                          <?php
                          foreach($value->category as $key_cat => $value_cat){
                            ?>
                            <span class="badge badge-secondary text-dark">{{ (string) $value_cat }} </span>
                            <?php
                            // print_r();
                          }
                          ?><br>
                          <a href="{{ $value->link }}" class="btn btn-primary mt-3">Detail</a>
                        </div>
                      </div>
                </div>

            <?php
        }
    }
        ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>