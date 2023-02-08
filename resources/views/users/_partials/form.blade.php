  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nome </label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Nome:" value="{{ $user->name ?? old('name') }}">
  </div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email </label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email:" value="{{ $user->email ?? old('email') }}">
  </div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Senha </label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Senha:" value="{{ old('password') }}">
  </div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Telefone</label>
      <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Insira seu número de telefone" value="{{ $user->phone_number ?? old('phone_number') }}">
  </div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Status </label>
      <select class="form-control" name="status" id="status">
          <option value="active" {{ ($user->status ?? old('status')) == 'active' ? 'selected' : '' }}>Ativo</option>
          <option value="inactive" {{ ($user->status ?? old('status')) == 'inactive' ? 'selected' : '' }}>Inativo</option>
      </select>
  </div>

  <div class="mb-3">
      <label for="exampleFormControlSelect1" class="form-label">Tipo de usuário</label>
      <select class="form-control" id="user_type" name="user_type">
          <option value="client" {{ ($user->user_type ?? old('user_type')) == 'client' ? 'selected' : '' }}>Cliente</option>
          <option value="agent" {{ ($user->user_type ?? old('user_type')) == 'agent' ? 'selected' : '' }}>Agente</option>
          <option value="admin" {{ ($user->user_type ?? old('user_type')) == 'admin' ? 'selected' : '' }}>Admin</option>
      </select>
  </div>

  <button type="submit" class="btn btn-success">Salvar</button>