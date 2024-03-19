</main>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js "></script>
<script src="<?= assets('/public/admin-panel/js/bootstrap.min.js') ?> "></script>
<script src="<?= assets('/public/admin-panel/js/mdb.min.js') ?> "></script>
<script src="<?= assets('/public/ckeditor/ckeditor.js') ?>"></script>
<script src="<?= assets('/public/babakhani-calender/persian-date.min.js') ?>"></script>
<script src="<?= assets('/public/babakhani-calender/persian-datepicker.min.js') ?>"></script>

<script>
    $(document).ready(function () {

        // Ck editor
        CKEDITOR.replace("body");
        CKEDITOR.replace('summary')

        // Persian calendar
        $('#published_at_view').persianDatepicker({

            observer: true,
            format: 'YYYY/MM/DD - HH:mm:ss',
            altField: '#published_at',


        })


    });
</script>

</body>

</html>