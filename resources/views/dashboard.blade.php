@extends('layouts.app')

@section('content')

    

        <main role="main" class="col-md-11 ml-sm-auto col-lg-11 pt-3 px-4 bg-light">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">


                {{-- dd($__data)--}}
              @isset($noresponseqs)
              @if ($noresponseqs[0]->type=="currency")

              <form method="POST" action="/dashboard">
              @csrf
                <label for="fname"><h5 class="card-title">{{$noresponseqs[0]->question}}</h5></label><br>
                <p class="card-text">$ <input type="text" id="currency" name="currency"></p><br>
                @error('currency')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="type" value="currency">
                <input type="hidden" name="question_id" value="{{$noresponseqs[0]->id}}">
                <input type="submit" class="btn btn-primary"value="Submit">
              </form> 
             
                  @endif

                  @if ($noresponseqs[0]->type=="checkbox")

              <form method="POST" action="/dashboard">
              @csrf
                <label for="question"><h5 class="card-title">{{$noresponseqs[0]->question}}</h5></label><br>
                @foreach ($noresponseqs[0]->responsesArray as $response)
                <input type="checkbox" id="checkbox" name="checkbox[]" value="{{$response}}">
                <label for="checkbox"> {{$response}}</label><br>
                @endforeach
                @error('checkbox')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="question_id" value="{{$noresponseqs[0]->id}}">
                <input type="hidden" name="type" value="checkbox">
                <input type="submit" class="btn btn-primary"value="Submit">
                
              </form> 
             
                  @endif

                  @if ($noresponseqs[0]->type=="radio")

              <form method="POST" action="/dashboard">
              @csrf
                <label for="question"><h5 class="card-title">{{$noresponseqs[0]->question}}</h5></label><br>
                @foreach ($noresponseqs[0]->responsesArray as $response)
                <input type="radio" id="{{$response}}" name="radio" value="{{$response}}">
                <label for="{{$response}}">{{$response}}</label><br>
                @endforeach
                @error('radio')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="question_id" value="{{$noresponseqs[0]->id}}">
                <input type="hidden" name="type" value="radio">
                <input type="submit" class="btn btn-primary"value="Submit">
                
              </form> 
             
                  @endif

                  @if ($noresponseqs[0]->type=="text")

              <form method="POST" action="/dashboard">
              @csrf
                <label for="question"><h5 class="card-title">{{$noresponseqs[0]->question}}</h5></label><br>
                
                <p class="card-text"><input type="text" id="text" name="text"></p><br>
                
                @error('text')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <input type="hidden" name="question_id" value="{{$noresponseqs[0]->id}}">
                <input type="hidden" name="type" value="text">
                <input type="submit" class="btn btn-primary"value="Submit">
                
              </form> 
             
                  @endif


                  @if ($noresponseqs[0]->type=="textarea")

                    <form method="POST" action="/dashboard">
                    @csrf
                      <label for="question"><h5 class="card-title">{{$noresponseqs[0]->question}}</h5></label><br>
                      
                      <textarea id="textarea" name="textarea" rows="4" cols="50">
                      </textarea><br>
                      @error('textarea')
                        <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                      <input type="hidden" name="question_id" value="{{$noresponseqs[0]->id}}">
                      <input type="hidden" name="type" value="textarea">
                      <input type="submit" class="btn btn-primary"value="Submit">
                      
                    </form> 

                        @endif
             @endisset
                </div>
            </div>


          </div>
            <div class="col-md-6">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            </div>
          </div>


          <div class="row pt-5">
            <div class="col-md-3">
              <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>


          </div>
            <div class="col-md-3">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            </div>

            <div class="col-md-3">
              <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>


          </div>
            <div class="col-md-3">
            <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
            </div>

          </div>

          <div class="row pt-5">
            <div class="col-md-12">
              <div class="card" style="width: 100%;">
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>

         
        </main>
       



@endsection

