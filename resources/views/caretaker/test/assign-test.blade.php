@section('pageTitle', "Assign Test to $patient->full_name")
@section('pageActionData')
    <a href="{{ route('caretaker.tests.index') }}"
        class="btn btn-fixed-height btn-primary font-weight-bolder font-size-sm px-5 my-1">Test List</a>

@endsection
<x-auth-layout>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom card-stretch gutter-b">
                <form action="{{ route('caretaker.tests.storeAssignTest', $patient) }}" method="post">
                    @csrf
                    <div class="card-body pt-7">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="test_id">
                                    Test:
                                </label>
                                <select name="test_id" id="test_id" class="form-control">
                                    <option value="">Select</option>
                                    @forelse ($tests as $test)
                                        <option value="{{ $test->id }}">{{  $test->name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <x-form-error-component :label='"test_id"' />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="due_date">
                                    Due Date:
                                </label>
                                <input type="text" class="form-control" id="due_date" placeholder="Select Due Date" name="due_date" readonly value="{{ old('due_date') }}" />
                                <x-form-error-component :label='"due_date"' />
                            </div>
                        </div>
						<div class="row mb-2">
							<div class="col-md-12 form-group">
								<textarea id="ai-suggestion" class="form-control" readonly></textarea>
							</div>
							<div class="col-md-3">
								<button class="btn btn-light-success" id="ai-suggestion-btn" type="button" ><span id="ai-suggestion-text">Get AI Suggestion</span></button>
							</div>
						</div>

                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('UserJS')
    <script>
        $(document).ready(function () {
            {
                $('#due_date').datepicker({
                    rtl: false,
                    todayHighlight: true,
                    orientation: "bottom left",
                });

				$('#ai-suggestion-btn').on('click', function() {
					$('#ai-suggestion').text("");
					$('#ai-suggestion-btn').prop('disabled', true);
					$('#ai-suggestion-text').text('Generating....');
					axios.post('{{ route('caretaker.tests.getAISuggestion', $patient)  }}').then(function(response){
						const data = response.data

						$('#ai-suggestion').text(data);
						$('#ai-suggestion-btn').prop('disabled', false);
						$('#ai-suggestion-text').text('Get AI Suggestion');
					});
				});
            }
        })
    </script>
    @endpush
</x-auth-layout>
