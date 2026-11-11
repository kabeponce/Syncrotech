    <!-- Cierre del contenedor main abierto en includes/menu.php. -->
    </main>
</div>
</div>

<!-- Bootstrap core JS de la plantilla -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Script de la plantilla: controla el boton que muestra/oculta el sidebar. -->
<script src="/syncrotech_manager/assets/js/template.js"></script>

<!-- jQuery y Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Activa Select2 en los select que tengan la clase .select2.
    $('.select2').select2({
        placeholder: "Buscar...",
        allowClear: true,
        width: '100%'
    });
});
</script>

</body>
</html>
