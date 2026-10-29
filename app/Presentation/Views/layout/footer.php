</main>
<!-- FOOTER -->
<footer class="bg-dark text-white py-4 border-top border-secondary">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-12">
                <p class="mb-0 small text-white-50">
                    &copy; <?= e((string) $layout->currentYear); ?> Derechos reservados <strong>UPDS</strong>. &middot;
                    <a href="#" class="text-white-50 text-decoration-none border-bottom">Privacidad</a>
                </p>
            </div>
        </div>
    </div>
</footer>

<!-- DataTables Core & Bootstrap 5 Integration (solo en páginas con tabla) -->
<?php if ($layout->withDataTables): ?>
<script defer src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" integrity="sha384-edQnMujp90eoACbp4sS9zj/0dMW+mjTJFxCNeW0hM7rVy4OutMVBq6ec4axiLP9U" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js" integrity="sha384-ON66nBewQ67SNHiJWBO8f7ldsYeQ6wShDTaaikVGjNyNxC7P2rTge/Gf77mL/Ijt" crossorigin="anonymous"></script>

<!-- DataTables Extensions: Responsive -->
<script defer src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js" integrity="sha384-PY2wFFZbq7kCYodfBP408z2yXR7heditX+7fcNGW1QlNvoNReFROjc2e+gETYS2J" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js" integrity="sha384-vH3aRzwnpaxVgteYf4GLvyv6ISN0tJmjKQtmtO2ZFJG4l7P64N+JGC56jsriiPQy" crossorigin="anonymous"></script>

<!-- DataTables Buttons: dependencias -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha384-+mbV2IY1Zk/X1p/nWllGySJSUN8uMs+gUAN10Or95UBH0fpj6GfKgPmgC5EXieXG" crossorigin="anonymous"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha384-VFQrHzqBh5qiJIU0uGU5CIW3+OWpdGGJM9LBnGbuIH2mkICcFZ7lPd/AAtI7SNf7" crossorigin="anonymous"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha384-/RlQG9uf0M2vcTw3CX7fbqgbj/h8wKxw7C3zu9/GxcBPRKOEcESxaxufwRXqzq6n" crossorigin="anonymous"></script>

<!-- DataTables Buttons: core + Bootstrap 5 + exportadores + ColVis -->
<script defer src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js" integrity="sha384-POmQLDS+gc6Qd3ZalIVuutsaZQkTDU8foo3J6egQy4YmrNhxcGuIlKXsas5XaZNG" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js" integrity="sha384-R/1aieuV27Trs+cczprs/2SFjCwdqKQo/4qYM0SBHv/wla+LSTHWds8FCw6s51Bb" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js" integrity="sha384-HTrhO6m5QbXzKQm/28HT6tYIdf/GeCK8xucgDpUbyrlqDwVh5AN5il4gcRxyIF51" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js" integrity="sha384-m1bkDRTx51kIl1OC2S24Tnj0vEwit7u2Be60VaV392LbUhm9qrm5GBlraC3S2U/l" crossorigin="anonymous"></script>
<script defer src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js" integrity="sha384-h/SRPFzc2+BE+XfOqlAqiHb43fnY8jzXhQ0fI1JBfgrjbxUokMr9To2eLbSWEt1g" crossorigin="anonymous"></script>
<?php endif; ?>

<!-- Custom Scripts -->
<script src="<?= e(app_url('/js/toast-config.js')); ?>"></script>
<?php if (!empty($layout->toastMessages)) : ?>
    <script>
        <?php foreach ($layout->toastMessages as $toast) : ?>
            window.showToast(
                <?= json_encode($toast['type'], JSON_UNESCAPED_UNICODE); ?>,
                <?= json_encode($toast['message'], JSON_UNESCAPED_UNICODE); ?>
            );
        <?php endforeach; ?>
    </script>
<?php endif; ?>
</body>

</html>
