from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium import webdriver
from selenium.webdriver.chrome.service import Service
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.support.ui import Select
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC

import random

import time


driver = webdriver.Chrome(service=Service(ChromeDriverManager().install()))


# Iniciar el navegador
driver = webdriver.Chrome()

# Ir a la página principal (donde está el botón "Ingreso")
driver.get("http://127.0.0.1:8000")  # Cambia si usas otra ruta
time.sleep(2)

# Hacer clic en el botón "Ingreso"
btn_ingreso = driver.find_element(By.CLASS_NAME, "button-ingreso")
btn_ingreso.click()
time.sleep(2)

# Aquí continuarás con la siguiente vista: login
# Esperar un momento a que cargue el DOM (opcional pero recomendado)
time.sleep(2)

# Hacer clic en el enlace "Regístrate"
driver.find_element(By.LINK_TEXT, "Regístrate").click()

# Esperar un momento para que cargue la vista de registro
time.sleep(2)

# Esperar que cargue la página de registro
time.sleep(2)

# Llenar nombre completo y teléfono
driver.find_element(By.ID, "name").send_keys("Sergio Arias")
driver.find_element(By.ID, "numero_telefono").send_keys("3001234567")

# Correo electrónico (puedes usar uno dinámico para pruebas múltiples)
email = f"sergio{random.randint(1000,9999)}@example.com"
driver.find_element(By.ID, "email").send_keys(email)

# Dirección
driver.find_element(By.ID, "address_line_1").send_keys("Calle 10 #15-30")

# Seleccionar barrio
select_barrio = Select(driver.find_element(By.ID, "neighborhood"))
select_barrio.select_by_visible_text("El Poblado")

# Seleccionar rol
select_rol = Select(driver.find_element(By.ID, "rol"))
select_rol.select_by_value("cliente")  # o .select_by_visible_text("Cliente")

# Contraseña
driver.find_element(By.ID, "inputContrasena").send_keys("Sergio1234@")

# Click en botón de registro
driver.find_element(By.CLASS_NAME, "btn-registro").click()

# Esperar que redireccione o cargue nueva vista (ajústalo según tu lógica)
time.sleep(5)
# Esperar que cargue la vista de tiendas
time.sleep(2)

# Buscar todas las tiendas en la sección con id "stores-cerca"
tiendas = driver.find_elements(By.CLASS_NAME, "card-tienda")

# Verifica que haya al menos 5 tiendas
if len(tiendas) >= 5:
    quinta_tienda = tiendas[4]  # Índice 4 = quinta tienda (índices empiezan en 0)

    # Buscar el botón "Ver tienda" dentro de esa tienda y hacer clic
    boton_ver = quinta_tienda.find_element(By.TAG_NAME, "button")
    driver.execute_script("arguments[0].scrollIntoView({behavior: 'smooth', block: 'center'});", boton_ver)
    time.sleep(1)  # esperar animación de scroll
    boton_ver.click()

    
else:
    print("⚠ No hay suficientes tiendas para seleccionar la quinta.")



# Esperar que cargue la vista de tienda
time.sleep(5)

# 1. Hacer clic en el ícono del menú hamburguesa
menu_icon = driver.find_element(By.ID, "icono-nav-bar")
menu_icon.click()

# 2. Esperar a que se despliegue el menú (puedes usar WebDriverWait si el despliegue tiene animación)
time.sleep(5)

# 3. Buscar el enlace o el contenedor que dice "Ajustes de cuenta"
ajustes = driver.find_element(By.XPATH, "//article[contains(@class, 'container-links')]/h3[contains(text(), 'Ajustes de cuenta')]")

# 4. Hacer clic en el ícono SVG (o su contenedor <a>) para redirigir a ajustes
icono_ajustes = driver.find_element(By.CSS_SELECTOR, "a[href='http://127.0.0.1:8000/perfil']")
icono_ajustes.click()

# 1. Abrir la sección de Información Personal
time.sleep(3)
info_personal_btn = driver.find_element(By.ID, "abrirContInfoPersonal")
info_personal_btn.click()

# 2. Esperar a que el formulario esté visible (puedes usar WebDriverWait si lo deseas)
time.sleep(3)

# 3. Llenar los campos con nuevos valores

# Nombre completo
nombre_input = driver.find_element(By.ID, "nombre")
nombre_input.clear()
nombre_input.send_keys("Sergio Arias Mejía")

# Teléfono
telefono_input = driver.find_element(By.ID, "telefono")
telefono_input.clear()
telefono_input.send_keys("3001234567")

# Correo electrónico
correo_input = driver.find_element(By.ID, "correo")
correo_input.clear()
correo_input.send_keys("sergio@example.com")

# Dirección principal
direccion_input = driver.find_element(By.ID, "direccion")
direccion_input.clear()
direccion_input.send_keys("Carrera 8 #15-20")

# Barrio (usamos Select si es un <select>)
select_barrio = Select(driver.find_element(By.ID, "neighborhood"))
select_barrio.select_by_visible_text("La Avanzada")  # cambia por uno existente

# 4. Guardar los cambios
guardar_btn = driver.find_element(By.CSS_SELECTOR, "input.btn-guardar[type='submit']")
guardar_btn.click()

import time
from selenium.webdriver.common.by import By

# Esperar un momento después de actualizar la información
time.sleep(3)

# 1. Abrir el menú de hamburguesa nuevamente
menu_hamburguesa = driver.find_element(By.ID, "icono-nav-bar")
menu_hamburguesa.click()

# 2. Esperar a que se despliegue la barra lateral
time.sleep(3)

# 3. Localizar el formulario de logout por su acción
form_logout = driver.find_element(By.XPATH, "//form[@action='http://127.0.0.1:8000/logout']")  # Asegúrate que /logout sea la ruta real
form_logout.submit()

# 4. Esperar a que cierre sesión
time.sleep(2)

# Click en enlace "Inicia sesión"
# driver.find_element(By.LINK_TEXT, "Inicia sesión").click()
# time.sleep(2)



