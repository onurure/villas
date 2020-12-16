@if($islem == 'subcategory')
	<select data-placeholder="Select Sub Category" class="chosen-select-no-single" name="subcategory" id="subcat">
		<option label="{{ Ceviri('Seçin') }}"></option>
		@foreach($subcategories as $subcategory)
			<option value="{{ $subcategory->id }}" {{ $subcategory->id == $selectone ? 'selected' : ''}}>{{ Ceviri($subcategory->title) }}</option>
		@endforeach
	</select>
@endif
