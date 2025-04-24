<div>
    <div class="card-body pt-7">
        <form wire:submit="save">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="name">
                        Test Name:
                    </label>
                    <input type="text" class="form-control" placeholder="Enter Test Name" wire:model="name" />
                    <x-form-error-component :label='"name"' />
                </div>
                <div class="col-md-6 form-group">
                    <label for="first_name">
                        Test Description:
                    </label>
                    <input type="text" class="form-control" placeholder="Enter test description" wire:model.live="description" />
                    <x-form-error-component :label='"description"' />
                </div>
                <div class="col-md-6 form-group">
                    <label for="test_type">
                        Test Type:
                    </label>
                    <select class="form-control" wire:model.live="test_type">
                        <option value="">Select</option>
                        <option value="ASSESSMENT">ASSESSMENT</option>
                        <option value="TRAINING">TRAINING</option>
                        <option value="GAME">GAME</option>
                    </select>
                    <x-form-error-component :label='"test_type"' />
                </div>
                <div class="col-md-6 form-group">
                    <label for="test_type">
                        Assessment:
                    </label>
                    <select class="form-control" wire:model="assessment_list_id">
                        <option value="">Select</option>
                        @forelse ($assessments as $assessment)
                            <option value="{{ $assessment['id'] }}">{{ $assessment['title'] }}</option>
                        @empty
                        @endforelse
                    </select>
                    <x-form-error-component :label='"assessment_list_id"' />
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>