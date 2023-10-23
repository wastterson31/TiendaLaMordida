@csrf

<!-- name -->
<div>
    <label class="form-label" for="name">Nombre:</label>
    <input class="form-control" type="text" name="name" id="name" placeholder="Ingrese el nombre"
        value="{{ old('name', $orders) }}">
    @error('name')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>


<!-- direccion -->
<div>
    <label class="form-label" for="address">Direccion:</label>
    <input class="form-control" type="text" name="address" id="address" accept="address" placeholder="Direccion"
        value="{{ old('address', $orders) }}">
    @error('address')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Descripcion -->
<div>
    <label class="form-label" for="description">Descripcion:</label>
    <input class="form-control" type="text" name="description" id="description" accept="description"
        placeholder="Ingrese la descripcion" value="{{ old('description', $orders) }}">
    @error('description')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- cantidad -->
<div>
    <label class="form-label" for="amount">Cantidad:</label>
    <input class="form-control" type="number" name="amount" id="amount" accept="amount"
        placeholder="Ingrese la cantidad" value="{{ old('amount', $orders) }}">
    @error('amount')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>

<!-- Descripcion -->
<div>
    <label class="form-label" for="price">Precio:</label>
    <input class="form-control" type="number" name="price" id="price" accept="price"
        placeholder="Ingrese el precio" value="{{ old('price', $orders) }}">
    @error('price')
        <div class="text-small text-danger">{{ $message }}</div>
    @enderror
</div>
