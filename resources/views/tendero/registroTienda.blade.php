<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('css/tendero/registroTienda.css') }}">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=ADLaM+Display&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <style>
            .error-input {
                border: 2px solid #dc3545 !important;
                background-color: #fff5f5 !important;
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            }
            
            .error-input:focus {
                border-color: #dc3545 !important;
                box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            }
            
            .error-message {
                color: #dc3545 !important;
                font-size: 0.875rem !important;
                margin-top: 5px !important;
                display: block !important;
                font-weight: 500 !important;
            }
            
            .alert {
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 15px 20px;
                border-radius: 5px;
                z-index: 10000;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                max-width: 400px;
                animation: slideInRight 0.5s ease-out;
            }
            
            .alert-success {
                background: #28a745;
                color: white;
            }
            
            .alert-error {
                background: #dc3545;
                color: white;
            }
            
            .alert-warning {
                background: #ffc107;
                color: #212529;
            }
            
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }
        </style>
    @endsection

    <main class="main-registro-tienda">
        <!-- Mensajes de sesión -->
        @if(session('success'))
            <div class="alert alert-success">
                <strong>¡Éxito!</strong><br>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <strong>Error:</strong><br>
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning">
                <strong>Advertencia:</strong><br>
                {{ session('warning') }}
            </div>
        @endif

        <!-- Mostrar errores de validación generales -->
        @if($errors->any())
            <div class="alert alert-error">
                <strong>Errores de validación:</strong><br>
                <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <section class="encabezado-principal">
            <h2>Configuración inicial de tu tienda</h2>
            <p>¡Primer paso para activar tu tienda!</p>
        </section>
        <section class="encabezado-secundario">
            <h3>Registro de tu tienda</h3>
            <div class="progreso-registro-tienda">
                <div class="barra-progreso">
                </div>
            </div>
            <p class="indicadorPaso"><span class="paso-actual"></span></p>
        </section>
        <form action="{{ route('tendero.storeRegistroTienda') }}" method="POST" enctype="multipart/form-data" class="form-registro-tienda">
            @csrf
            <section class="cont-form-info-basica">
                <article class="cont-titulo-seccion">
                    <h3 class="titulo-seccion">Información básica de la tienda</h3>
                </article>
                <article class="cont-input-info-basica">
                    <label for="nombreTienda">Nombre de tu tienda</label>
                    <input type="text" name="store_name" id="nombreTienda" value="{{ old('store_name') }}" required 
                           class="{{ $errors->has('store_name') ? 'error-input' : '' }}">
                    @error('store_name')
                        <span class="error-message">
                            <strong>Error:</strong> {{ $message }}
                        </span>
                    @enderror
                </article>
                <article class="cont-input-info-basica">
                    <label for="telefonoTienda">Teléfono de contacto tu tienda</label>
                    <input type="tel" name="delivery_contact_phone" id="telefonoTienda" value="{{ old('delivery_contact_phone') }}"
                           class="{{ $errors->has('delivery_contact_phone') ? 'error-input' : '' }}">
                    @error('delivery_contact_phone')
                        <span class="error-message" style="color: #dc3545; font-size: 0.875rem; margin-top: 5px; display: block;">
                            <strong>Error:</strong> {{ $message }}
                        </span>
                    @enderror
                </article>
                <article class="cont-input-info-basica">
                    <label for="direccionTienda">Dirección de tu tienda</label>
                    <input type="text" name="address_line_1" id="direccionTienda" value="{{ old('address_line_1') }}" required
                           class="{{ $errors->has('address_line_1') ? 'error-input' : '' }}">
                    @error('address_line_1')
                        <span class="error-message" style="color: #dc3545; font-size: 0.875rem; margin-top: 5px; display: block;">
                            <strong>Error:</strong> {{ $message }}
                        </span>
                    @enderror
                </article>
                <article class="cont-input-info-basica">
                    <p>Barrio</p>
                    <select name="neighborhood" id="barrioSelect" required
                            class="{{ $errors->has('neighborhood') ? 'error-input' : '' }}">
                        <option value="">Seleccione una opción</option>
                        @foreach($barrios as $barrio)
                            <option value="{{ $barrio->nombre_barrio }}" {{ old('neighborhood') == $barrio->nombre_barrio ? 'selected' : '' }}>
                                {{ $barrio->nombre_barrio }}
                            </option>
                        @endforeach
                    </select>
                    @error('neighborhood')
                        <span class="error-message" style="color: #dc3545; font-size: 0.875rem; margin-top: 5px; display: block;">
                            <strong>Error:</strong> {{ $message }}
                        </span>
                    @enderror
                </article>
                <article class="cont-input-info-basica">
                    <p>Descripción breve de la tienda</p>
                    <textarea name="description" id="descripcionTienda" placeholder="Agrega una breve descripcion de tu tienda"
                              class="{{ $errors->has('description') ? 'error-input' : '' }}">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="error-message" style="color: #dc3545; font-size: 0.875rem; margin-top: 5px; display: block;">
                            <strong>Error:</strong> {{ $message }}
                        </span>
                    @enderror
                </article>
                <article class="cont-titulo-seccion">
                    <h3 class="titulo-seccion">Imagen de la tú tienda</h3>
                </article>
                <article class="cont-input-info-basica-img">
                    <label for="imagenInput">Sube imagen de tu tienda
                        <img src="{{ asset('img/camera.svg') }}" alt="">
                    </label>
                    <input type="file" accept="image/*" name="logo" id="imagenInput" alt="Agrega una imagen de tu tienda" class="input-subir-imagen">
                    <div id="preview">
                    </div>
                    @error('logo')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </article>
            </section>
            <section class="cont-form-info-2">
                <section class="cont-horarios">
                    <article class="cont-titulo-seccion titulo-hoarios">
                        <h3 class="titulo-seccion">Información básica de la tienda</h3>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxLunes">Lunes
                            <input type="checkbox" id="checkboxLunes" class="checkbox" name="dias[]" value="Lunes">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_lunes">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_lunes">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxMartes">Martes
                            <input type="checkbox" id="checkboxMartes" class="checkbox" name="dias[]" value="Martes">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_martes">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_martes">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxMiercoles">Miercoles
                            <input type="checkbox" id="checkboxMiercoles" class="checkbox" name="dias[]" value="Miércoles">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_miercoles">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_miercoles">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxJueves">Jueves
                            <input type="checkbox" id="checkboxJueves" class="checkbox" name="dias[]" value="Jueves">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_jueves">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_jueves">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxViernes">Viernes
                            <input type="checkbox" id="checkboxViernes" class="checkbox" name="dias[]" value="Viernes">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_viernes">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_viernes">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxSabado">Sábado
                            <input type="checkbox" id="checkboxSabado" class="checkbox" name="dias[]" value="Sábado">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_sabado">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_sabado">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                    <article class="cont-checkbox">
                        <label for="checkboxDomingo">Domingo
                            <input type="checkbox" id="checkboxDomingo" class="checkbox" name="dias[]" value="Domingo">
                            <span class="checkmark"></span>
                        </label>
                        <article class="cont-select">
                            <select name="hora_inicio_domingo">
                                <option value="5:00">5:00 a.m</option>
                                <option value="6:00">6:00 a.m</option>
                                <option value="7:00">7:00 a.m</option>
                                <option value="8:00">8:00 a.m</option>
                                <option value="9:00" selected>9:00 a.m</option>
                                <option value="10:00">10:00 a.m</option>
                                <option value="11:00">11:00 a.m</option>
                                <option value="12:00">12:00 p.m</option>
                            </select>
                            <span>a</span>
                            <select name="hora_fin_domingo">
                                <option value="13:00">1:00 p.m</option>
                                <option value="14:00">2:00 p.m</option>
                                <option value="15:00">3:00 p.m</option>
                                <option value="16:00">4:00 p.m</option>
                                <option value="17:00">5:00 p.m</option>
                                <option value="18:00" selected>6:00 p.m</option>
                                <option value="19:00">7:00 p.m</option>
                                <option value="20:00">8:00 p.m</option>
                                <option value="21:00">9:00 p.m</option>
                                <option value="22:00">10:00 p.m</option>
                            </select>
                        </article>
                    </article>
                </section>
                <section class="cont-servicios">
                    <article class="cont-titulo-seccion titulo-servicios">
                        <h3 class="titulo-seccion">Selecciona los servicios que ofreces</h3>
                    </article>
                    <article class="cont-service-pago">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" id="motorcycle-delivery">
                            <g>
                              <path fill="#747575" d="M38 47H28a1 1 0 0 1 0-2h10a1 1 0 0 1 0 2zm-27 0H2a1 1 0 0 1 0-2h9a1 1 0 0 1 0 2zm13 0h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"></path>
                              <path fill="#c4455e" d="M21 27v5h-8a5 5 0 0 0-5 5v4H1v-4a12 12 0 0 1 12-12h6a2 2 0 0 1 2 2Z"></path>
                              <path fill="#db5669" d="M19 25h-6a12 12 0 0 0-10.87 6.93C6.35 27.3 10.94 28 17 28a2 2 0 0 1 2 2v2h2v-5a2 2 0 0 0-2-2zm18 6-4 10H21v-4h6.49a2 2 0 0 0 2-1.83C31.14 14.22 31 16.27 31 16l4 1c.2 1.42-.13-.85 2 14z"></path>
                              <path fill="#f26674" d="M37 31c-3.29 8.23-3.3 8-3.2 8a1.36 1.36 0 0 1-1.26-1.86L35 31c-2.13-14.85-1.8-12.6-2-14-2.4-.6-2.05-.32-2-1l4 1c.2 1.42-.13-.85 2 14Z"></path>
                              <path fill="#db5669" d="M39 10v6a1 1 0 0 1-1 1h-5a4 4 0 0 1 0-8h5a1 1 0 0 1 1 1Z"></path>
                              <path fill="#c4455e" d="M35.14 18c-2 0-3.06.15-4.25-.61.16-1.86-.27-.39 2.11-.39h2Z"></path>
                              <path fill="#fc6" d="M42 13a3 3 0 0 1-3 3v-6a3 3 0 0 1 3 3Z"></path>
                              <path fill="#ffde76" d="M41.56 14.56A3 3 0 0 1 40 15v-4.82a3 3 0 0 1 1.56 4.38Z"></path>
                              <path fill="#374f68" d="M31 14h-6a1 1 0 0 1 0-2h6a1 1 0 0 1 0 2Z"></path>
                              <path fill="#c4455e" d="M47 41H33c4.39-11 3.86-10 4.33-10A10 10 0 0 1 47 41Z"></path>
                              <path fill="#db5669" d="M46.8 39h-13l3.2-8a10 10 0 0 1 9.8 8Z"></path>
                              <path fill="#374f68" d="M17 41a6 6 0 0 1-12 0zm26.91 1c-1.1 6.64-10.72 6.63-11.82 0z"></path>
                              <path fill="#7c7d7d" d="M13 41a2 2 0 0 1-4 0zm26.73 1a2 2 0 0 1-3.46 0z"></path>
                              <path fill="#a87e6b" d="M1 13h14v12H1z"></path>
                              <path fill="#be927c" d="M15 13v10H9a4 4 0 0 1-4-4v-6Z"></path>
                              <path fill="#2c435e" d="M21 25h-6v-4c1.91 0 4.13-.31 5.46 2a4 4 0 0 1 .54 2Z"></path>
                              <path fill="#374f68" d="M20.46 23H15v-2c1.91 0 4.13-.31 5.46 2Z"></path>
                              <path fill="#f6ccaf" d="M10 13v6l-2-1-2 1v-6h4z"></path>
                              <path fill="#f26674" d="M39 10v5h-1a6 6 0 0 1-6-6h6a1 1 0 0 1 1 1Z"></path>
                              <path fill="#374f68" d="M32 10c-.75 0-.61-.07-3.83-5.45a1 1 0 0 1 1.66-1.1l3 5A1 1 0 0 1 32 10Z"></path>
                              <path fill="#db5669" d="M28 5h-3V1h3a2 2 0 0 1 0 4zm-7 27v9H8v-4a5 5 0 0 1 5-5z"></path>
                              <path fill="#f26674" d="M13 32a5 5 0 0 0-4.37 2.63C10.11 33.82 10.28 34 19 34v7h2v-9Z"></path>
                              <path fill="#ffdec7" d="M10 13v4H9a2 2 0 0 1-2-2v-2Z"></path>
                              <path fill="#747575" d="M40 41a2 2 0 0 1-.27 1h-3.46a2 2 0 0 1-.27-1Z"></path>
                              <path fill="#2c435e" d="M36 41a2 2 0 0 0 .27 1h-4.18a5.47 5.47 0 0 1-.09-1zm8 0a5.47 5.47 0 0 1-.09 1h-4.18a2 2 0 0 0 .27-1z"></path>
                              <path fill="#747575" d="M13 41a2 2 0 0 1-.27 1H9.27A2 2 0 0 1 9 41Z"></path>
                              <path fill="#2c435e" d="M9 41a2 2 0 0 0 .27 1H5.09A5.47 5.47 0 0 1 5 41zm8 0a5.47 5.47 0 0 1-.09 1h-4.18a2 2 0 0 0 .27-1z"></path>
                            </g>
                        </svg>
                        <label for="checkboxDomicilio">Domicilios
                            <input type="checkbox" id="checkboxDomicilio" name="offers_delivery" value="1" class="checkboxMetodo">
                            <p>Ofreces servicio de entrega a domicilio (gestionado por ti)</p>
                        </label>
                    </article>
                </section>
                <section class="cont-contacto-domicilio">
                    <article class="cont-titulo-seccion">
                        <h3 class="titulo-seccion">Información de domicilio</h3>
                    </article>
                    <article class="cont-advertencia-domicilio">
                        <img src="{{ asset('img/alert-triangle.svg') }}" alt="información importante">
                        <section class="cont-info-adevertencia-domicilio">
                            <h4 class="titulo-adevertencia-domicilio">Importante sobre Domicilios</h4>
                            <p class="info-adevertencia-domicilio">
                                PediYÁ no gestiona la logística ni el cobro del domicilio. Los clientes te contactarán directamente para coordinar la entrega y el pago.
                            </p>
                        </section>
                    </article>
                </section>
            </section>
            <section class="cont-form-info-3">
            <article class="container-general-form-info-3">
                    <article class="cont-titulo-seccion">
                        <h3 class="titulo-seccion">Métodos de Pago que Aceptas</h3>
                    </article>
                    <article class="cont-check-metodos-pago">
                        <label for="checkboxEfectivo">Efectivo
                            <input type="checkbox" id="checkboxEfectivo" name="payment_methods[]" value="1" class="checkboxMetodoPago">
                        </label>
                        <label for="checkboxTransferenciaBancaria">Transferencia bancaria
                            <input type="checkbox" id="checkboxTransferenciaBancaria" name="payment_methods[]" value="2" class="checkboxMetodoPago">
                        </label>
                        <label for="checkboxNequi">Nequi
                            <input type="checkbox" id="checkboxNequi" name="payment_methods[]" value="3" class="checkboxMetodoPago">
                        </label>
                        <label for="checkboxPSE">PSE
                            <input type="checkbox" id="checkboxPSE" name="payment_methods[]" value="4" class="checkboxMetodoPago">
                        </label>
                        <label for="checkboxTarjetaCredito">Tarjeta de Crédito
                            <input type="checkbox" id="checkboxTarjetaCredito" name="payment_methods[]" value="5" class="checkboxMetodoPago">
                        </label>
                        <label for="checkboxTransferenciaDebito">Tarjeta de Débito
                            <input type="checkbox" id="checkboxTransferenciaDebito" name="payment_methods[]" value="6" class="checkboxMetodoPago">
                        </label>
                        @error('payment_methods')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </article>
                <article class="container-general-form-info-3">
                    <article class="cont-documentos-requeridos">
                        <section class="cont-titulo-seccion">
                            <h3 class="titulo-seccion">Documentos requeridos</h3>
                        </section>
                        <section class="cont-documento">
                            <h4>1</h4>
                            <label for="subirDocumentoIdentidad">
                                <input type="file" id="subirDocumentoIdentidad" name="documento_identidad" class="subir-documento-input" accept=".pdf,.jpg,.jpeg,.png" required>
                                <article class="info-documento">
                                    <p>Identificaciòn del propietario</p>
                                    <p>Cédula de ciudadanía o cédula de extranjería</p>
                                </article>
                                <img src="{{ asset('img/file.svg') }}" alt="subir documento">
                            </label>
                            @error('documento_identidad')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </section>
                        <section class="cont-documento">
                            <article class="sub-cont-documento">
                                <h4>2</h4>
                                <article class="info-documento">
                                    <p>Número de RUT</p>
                                    <p>Regsitro único Tributario</p>
                                </article>
                            </article>
                            <input type="text" name="runt_number" id="numeroDeRut" value="{{ old('runt_number') }}">
                        </section>
                        <section class="cont-documento">
                            <h4>3</h4>
                            <label for="subirDocumentoCamaraComercio">
                                <input type="file" id="subirDocumentoCamaraComercio" name="documento_camara_comercio" class="subir-documento-input" accept=".pdf,.jpg,.jpeg,.png" required>
                                <article class="info-documento">
                                    <p>Registro de Cámara de Comercio</p>
                                    <p>Certificado de existencia y representación legal</p>
                                </article>
                                <img src="{{ asset('img/file.svg') }}" alt="subir documento">
                            </label>
                            @error('documento_camara_comercio')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </section>
                        <section class="cont-check-autorizacion">
                            <input type="checkbox" name="authorization" value="1" id="autorizacionDocuemntos" required>
                            <label for="autorizacionDocuemntos"> 
                                Declaro que toda la información proporcionada es verídica y autorizo su verificación para el proceso de registro en PediYÁ.
                            </label>
                            @error('authorization')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </section>
                        
                    </article>
                    <article class="cont-informacion-importante">
                        <section class="cont-titulo-seccion">
                            <h3 class="titulo-seccion">Información importante</h3>
                        </section>
                        <section class="cont-aviso-1">
                            <img src="{{ asset('img/alert-triangle.svg') }}" alt="información importante">
                            <section class="cont-info-aviso-1">
                                <h4 class="titulo-aviso-1">Proceso de verificación</h4>
                                <p class="info-aviso-1">
                                    Una vez completes tu registro, nuestro equipo verificará la información y documentos. Este proceso puede tomar entre 24-48 horas. Te notificaremos por correo electrónico cuando tu tienda esté activa.
                                </p>
                            </section>  
                        </section>
                        <section class="cont-aviso-2">
                            <img src="{{ asset('img/verified.svg') }}" alt="">
                            <section class="cont-info-aviso-2">
                                <h4 class="titulo-aviso-2">¡Próximo Paso!</h4>
                                <p class="info-aviso-2">
                                    Una vez activada tu tienda, podrás agregar productos, gestionar inventario y comenzar a recibir pedidos de clientes en tu barrio.
                                </p>
                            </section>
                        </section>
                    </article>
                </article>
            </section>
            <section class="cont-acciones-form">
                <button type="button" class="btn-volver">Volver</button>
                <button type="button" class="btn-siguiente">Siguiente</button>
                <input type="submit" value="Publicar tienda" name="" class="btn-input-submit" id="enviarRegistroTienda">
            </section>
        </form>
    </main>

    @section('scripts')
        <script src="{{ asset('js/tendero/registroTienda.js') }}"></script>
        <script>
            // Manejo de mensajes de alerta
            document.addEventListener('DOMContentLoaded', function() {
                // Auto-ocultar mensajes de alerta después de 5 segundos
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.style.animation = 'slideOutRight 0.5s ease-out';
                        setTimeout(() => {
                            if (alert.parentNode) {
                                alert.parentNode.removeChild(alert);
                            }
                        }, 500);
                    }, 5000);
                });

                // Si hay un mensaje de éxito, redirigir al home del tendero después de 3 segundos
                @if(session('success'))
                    setTimeout(() => {
                        window.location.href = '{{ route("homeTendero") }}';
                    }, 3000);
                @endif
            });

            // Agregar estilos CSS para las animaciones
            const style = document.createElement('style');
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                    to {
                        transform: translateX(0);
                        opacity: 1;
                    }
                }
                
                @keyframes slideOutRight {
                    from {
                        transform: translateX(0);
                        opacity: 1;
                    }
                    to {
                        transform: translateX(100%);
                        opacity: 0;
                    }
                }
            `;
            document.head.appendChild(style);
        </script>
    @endsection
</x-app-layout>