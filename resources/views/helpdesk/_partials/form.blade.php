  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Assunto </label>
      <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto:" value="{{ $helpdeskCall->subject ?? old('subject') }}">
  </div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Descrição </label>
      <textarea class="form-control" id="description" name="description" rows="3"> {{ $helpdeskCall->description ?? old('description') }}</textarea>
  </div>