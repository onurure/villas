@if($islem == 'subcategory')
	<select data-placeholder="Select Sub Category" class="chosen-select-no-single" name="subcategory" id="subcat">
		<option label="{{ Ceviri('Seç') }}"></option>
		@foreach($subcategories as $subcategory)
			<option value="{{ $subcategory->id }}" {{ $subcategory->id == $selectone ? 'selected' : ''}}>{{ $subcategory->title }}</option>
		@endforeach
	</select>
@endif
