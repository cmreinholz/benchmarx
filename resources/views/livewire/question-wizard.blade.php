<div>

   

@if(!empty($successMessage))

<div class="alert alert-success">

   {{ $successMessage }}

</div>

@endif

  

<div class="stepwizard">

    <div class="stepwizard-row setup-panel">

        <div class="stepwizard-step">

            <a href="#step-1" type="button" class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-primary' }}">1</a>

            <p>Step 1</p>

        </div>

        <div class="stepwizard-step">

            <a href="#step-2" type="button" class="btn btn-circle {{ $currentStep != 2 OR $currentStep != 2.1 ? 'btn-default' : 'btn-primary' }}">2</a>

            <p>Step 2</p>

        </div>

        <div class="stepwizard-step">

            <a href="#step-3" type="button" class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">3</a>

            <p>Step 3</p>

        </div>

        <div class="stepwizard-step">

            <a href="#step-4" type="button" class="btn btn-circle {{ $currentStep != 4 ? 'btn-default' : 'btn-primary' }}" disabled="disabled">4</a>

            <p>Step 4</p>

        </div>

    </div>

</div>

  

    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">

        <div class="col-xs-12">

            <div class="col-md-12">

                <h3> Step 1</h3>

  

                <div class="form-group">

                    <label for="question">Question:</label>

                    <input type="text" wire:model="question" class="form-control" id="question">

                    @error('question') <span class="error">{{ $message }}</span> @enderror

                </div>

                <div class="form-group">

                    <label for="type">Question Type:</label>

                    <select wire:model="type" class="form-control" name="type" id="type"/>
                        <option value="empty">Select One</option>
                        <option value="radio">Radio</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="text">Text</option>
                        <option value="currency">Currency</option>
                        
                        <option value="textarea">Text Area</option>
                    </select>
                    @error('type') <span class="error">{{ $message }}</span> @enderror

                </div>

  

                <div class="form-group">
                <input type="checkbox" id="dependent" name="dependent" wire:model="dependent"  >
                <label for="dependent"> Select if this question is dependent on the response from another question.</label><br>

                    
                </div>
                <div class="form-group">
                <input type="checkbox" id="active" name="active" wire:model="active"  >
                <label for="active"> Select if this question will be active.</label><br>

                    
                </div>

  

                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button" >Next</button>

            </div>

        </div>

    </div>

    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">

        <div class="col-xs-12">

            <div class="col-md-12">

                <h3> Step 2</h3>
                <div class="row">
                    <div class="col-md-9">
                        <div class="form-group">
                        <label for="dependent_id">Which question is this new question dependent on?</label><br/>
                        <select wire:model="dependent_id" name="dependent_id" id="dependent_id">

                            <option selected="selected" disabled>Select a Question</option>
                            @foreach($allquestions as $q)
                            <option value="{{ $q->id }}">{{ $q->question }}</option>
                            @endforeach

                        </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                        <button class="btn text-white btn-info btn-sm" wire:click="getresponses">Get Responses</button>
                    </div>
                
                </div>
                </div>

</div>

</div>
                <div class="row setup-content {{ $currentStep != 2.1 ? 'displayNone' : '' }}" id="step-2-1">
                <div class="col-md-12">
                        <div class="form-group">
                        <label for="dependent_response">This question will only be shown if the following response is selected. </label><br/>
                        <select wire:model="dependent_response" name="dependent_response" id="dependent_response">
                        
                            <option selected="selected" disabled>Select a Response</option>
                         @foreach($dresponses as $d)
                            <option value="{{ $d }}">{{ $d }}</option>
                            @endforeach 

                        </select>
                    </div>
                    </div>
                    
 

                
    

                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" wire:click="secondStepSubmit">Next</button>

                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>
            </div>


    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">

        <div class="col-xs-12">

            <div class="col-md-12">

                <h3> Step 3</h3>

  

                <table class="table">

                    <tr>

                        <td>Question:</td>

                        <td><strong>{{$question}}</strong></td>

                    </tr>

                   
                </table>
                <form>
        <div class=" add-input">
            <div class="row">
                <div class="col-md-10">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Add Response" wire:model="response.0">
                        @error('response.0') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>
              
                
                <div class="col-md-2">
                    <button class="btn text-white btn-info btn-sm" wire:click.prevent="add({{$i}})">Add</button>
                </div>
            </div>
        </div>

                @foreach($inputs as $key => $value)
            <div class=" add-input">
                <div class="row">
                    <div class="col-md-10">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter response" wire:model="response.{{ $value }}">
                            @error('response.'.$value) <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <button class="btn btn-danger btn-sm" wire:click.prevent="remove({{$key}})">Remove</button>
                    </div>
                </div>
            </div>
        @endforeach

  

                <button class="btn btn-success btn-lg pull-right" wire:click="thirdStepSubmit" type="button">Next</button>

                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>

            </div>

        </div>

    </div>

    <div class="row setup-content {{ $currentStep != 4 ? 'displayNone' : '' }}" id="step-4">

<div class="col-xs-12">

    <div class="col-md-12">

        <h3> Step 4</h3>



        <table class="table">

            <tr>

                <td>Question:</td>

                <td><strong>{{$question}}</strong></td>

            </tr>

            <tr>

                <td>Question Type</td>

                <td><strong>{{$type}}</strong></td>

            </tr>

            

            <tr>

                <td>Dependent:</td>

                <td><strong>{{$dependent}}</strong></td>

            </tr>

            
            <tr>

                <td>Dependent Response:</td>

                <td><strong>{{$dependent_response}}</strong></td>

            </tr>

            <tr>

                <td>Responses:</td>
                
                <td><strong>{{$responsejson}}</strong}></td>
               
            </tr>
            
            <tr>

            <td>Active:</td>

            <td><strong>{{$active}}</strong}></td>

            </tr>
        </table>



        <button class="btn btn-success btn-lg pull-right" wire:click="submitForm" type="button">Finish!</button>

        <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="back(1)">Back</button>

    </div>

</div>

</div>

</div>
