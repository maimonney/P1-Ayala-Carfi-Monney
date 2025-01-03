# **Proyecto de Gestión de Servicios y Reservas**

### **Datos del Proyecto**
- **Autores**: Daiana Ayala, Sofía Carafi y Mailen Monney  
---

## **Descripción del Proyecto**

Este proyecto es una aplicación completa desarrollada con **Laravel** y **MySQL** que permite a los usuarios explorar servicios, realizar reservas, y efectuar pagos mediante **Mercado Pago**. Además, incluye un panel de administración para gestionar usuarios, servicios, blogs y reservas.

### **Funcionalidades principales:**
- **Vista pública**:
  - Página de inicio con introducción al sitio.
  - Sección de **Servicios**, con detalle individual y opción de reserva.
  - Sección de **Blogs** para mantener informados a los usuarios.
  - Formulario de contacto para enviar mensajes al administrador.
  
- **Panel de administración**:
  - **Gestión de Servicios**: Crear, editar y eliminar servicios.
  - **Gestión de Blogs**: Crear, editar y eliminar entradas de blog.
  - **Gestión de Usuarios**: Ver, editar y eliminar usuarios registrados.
  - **Panel de Reservas**:
    - Visualizar qué usuarios han reservado cada servicio.
    - Gestionar el estado de las reservas (Pendientes y Completadas).
  
- **Sistema de Roles**:
  - **Usuario**: Acceso a la reserva de servicios, blogs y visualización de datos personales.
  - **Administrador**: Acceso completo al panel de administración.
  
- **Autenticación y Registro**:
  - Inicio de sesión y registro con validaciones.
  - Gestión segura de contraseñas y sesiones.

- **Integración con Mercado Pago**:
  - Realiza pagos de servicios directamente desde la plataforma.

---

## **Características Técnicas**

### **Estructura de la Aplicación**
- **Frontend**:
  - Estilos personalizados con CSS y Bootstrap.
  
- **Backend**:
  - **Framework Laravel**: Para gestión de rutas, controladores, y middleware.
  - **Base de datos MySQL**: Para almacenamiento de usuarios, servicios, blogs y reservas.

### **Flujo del Proyecto**
1. Los usuarios exploran los servicios disponibles y seleccionan uno para reservar.
2. Una vez seleccionado, se dirigen a Mercado Pago para completar el pago.
3. El estado de la reserva se actualiza automáticamente en el panel de administración.
4. Los administradores pueden gestionar los servicios, blogs y usuarios desde el panel.

---

## **Tecnologías utilizadas**

- **Backend**: Laravel (PHP), MySQL.  
- **Frontend**: Bootstrap, CSS personalizado.  
- **Integración de pagos**: Mercado Pago.  

---
## **Requisitos para la instalación**

1. **Clonar el repositorio**:
   ```bash
   git clone https://github.com/maimonney/P1-Ayala-Carfi-Monney.git

