<?php

namespace App\Livewire;

use App\Models\CognifitCognitiveAssessmentList;
use App\Models\Test;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Session;

class CreateTestComponent extends Component
{
    public Test|null $test = null;
    public $name = "";
    public $description = "";
    public $test_type = "";
    public $assessment_list_id = "";
    public $created_by = "";
    public $assessments = [];
    public $assessmentList = [];

    public function mount()
    {
        $this->assessmentList = $this->getAssessmentList();
        $this->assessments = $this->assessmentList;
        $this->loadTest();
    }

    protected function validationAttributes()
    {
        return [
            'assessment_list_id' => 'Assessment',
        ];
    }

    public function render()
    {
        return view('livewire.create-test-component');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'test_type' => 'required',
            'assessment_list_id' => 'required',
        ]);

        if(!$this->test) {
            Test::create([
                'name' => $this->name,
                'description' => $this->description,
                'test_type' => $this->test_type,
                'assessment_list_id' => $this->assessment_list_id,
                'created_by' => auth()->user()->id
            ]);

            Session::flash('message.level', 'success');
            Session::flash('message.content', 'Test created successfully.');
        } else {
            $this->test->update([
                'name' => $this->name,
                'description' => $this->description,
                'test_type' => $this->test_type,
                'assessment_list_id' => $this->assessment_list_id,
            ]);

            Session::flash('message.level', 'success');
            Session::flash('message.content', 'Test updated successfully.');
        }

        return redirect()->route('caretaker.tests.index');
    }


    #[Computed]
    public function getAssessmentList(): array
	{
        return CognifitCognitiveAssessmentList::get()->toArray();
    }

    public function loadTest() {
        if($this->test) {
            $this->name = $this->test->name;
            $this->description = $this->test->description;
            $this->test_type = $this->test->test_type;
            $this->assessment_list_id = $this->test->assessment_list_id;
            $this->updatedTestType($this->test_type);
        }
    }
    public function updatedTestType($value)
    {
        $this->assessments = collect($this->assessmentList)->filter(function ($assessment) use ($value) {
            return $assessment['type'] == $value;
        });
    }
}
