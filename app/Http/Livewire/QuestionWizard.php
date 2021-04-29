<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Question;

class QuestionWizard extends Component
{
    public $currentStep = 1;

    public $question;
    public $type;
    public $dependent;
    public $dependent_id;
    public $dependent_response;
    public $response;
    public $allresponses;
    public $dresponses=[];
    public $name;
    public $active;
    public $allquestions;
    public $responsejson;

    public $successMessage = '';

    public $inputs = [];
    public $i = 1;

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function mount()
    {
        $this->allquestions = Question::where('type','=','radio')->orWhere('type','=','checkbox')->get();
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function render()
    {
        return view('livewire.question-wizard');
    }

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function getresponses()
    {
       
        $this->dependentresponses = Question::select('responses')->where('id', '=',$this->dependent_id)->get();   
        $this->dresponses=json_decode($this->dependentresponses[0]->responses, true);
      
        
        $this->currentStep=2.1;
       

    }

    public function firstStepSubmit()
    {
        $validatedData = $this->validate([
            'question' => 'required',

            'type' => 'required',
        ]);
        //dd($this->dependent);
        if ($this->dependent == true) {
            $this->currentStep = 2;
        } elseif ($this->dependent == false and ($this->type == 'text' or $this->type == 'textarea' or $this->type == 'currency')) {
            $this->currentStep = 4;
        } else {
            $this->currentStep = 3;
        }
    }

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function secondStepSubmit()
    {
        /*$validatedData = $this->validate([

            'stock' => 'required',

            'status' => 'required',

        ]);*/
        //dd($this->type);

        if ($this->type == 'checkbox' or $this->type == 'radio') {
            $this->currentStep = 3;
        } else {
            $this->currentStep = 4;
        }
    }

    public function thirdStepSubmit()
    {//dd($this);
        if ($this->type == 'checkbox' or $this->type == 'radio') {
            $validatedData = $this->validate([
                'response.0' => 'required',
            ]);
        }

       $this->responsejson = json_encode($this->response, true);
        $this->currentStep = 4;
    }

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function submitForm()
    {
        //dd($this->responsejson);
        Question::create([
            'question' => $this->question,

            'type' => $this->type,

            'responses' => $this->responsejson,

            'active' => $this->active,

            'dependent_id' => $this->dependent_id,

            'dependent_response' => $this->dependent_response,
        ]);

        $this->successMessage = 'Question Created Successfully.';

        $this->clearForm();

        $this->currentStep = 1;
    }

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**

     * Write code on Method

     *

     * @return response()

     */
    public function clearForm()
    {
        $this->question = '';

        $this->type = '';

        $this->response = '';
        $this->responsejson = '';

        $this->dependent = '';

        $this->i = 1;

        $this->active = '';

        $this->dependent_response='';

        // $this->active = '';
    }
}
