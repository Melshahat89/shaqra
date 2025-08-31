		<div class="form-group {{ $errors->has("courses") ? "has-error" : "" }}">
			<label class="col-md-2 col-form-label" for="courses">{{ trans( "courses.courses") }}</label>
			@php $courses = App\Application\Model\Courses::pluck("title" ,"id")->all()  @endphp
			@php  
			if(isset($item)){

				$courses_id = $item->courses_id;
			}elseif(isset($data['courses_id'])){

				$courses_id = $data['courses_id'];

			}else{
				$courses_id = null;

			}
			@endphp
			<select name="courses_id"  class="form-control" >
			@foreach( $courses as $key => $relatedItem)
			<option value="{{ $key }}"  {{ $key == $courses_id  ? "selected" : "" }}> {{ is_json($relatedItem) ? getDefaultValueKey($relatedItem) :  $relatedItem}}</option>
			@endforeach
			</select>
			@if ($errors->has("courses"))
				<div class="alert alert-danger">
					<span class="help-block">
						<strong>{{ $errors->first("courses") }}</strong>
					</span>
				</div>
			@endif
			</div>