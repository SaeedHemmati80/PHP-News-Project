</main>
</div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js "></script>
<script src="<?= assets('/public/admin-panel/js/bootstrap.min.js') ?> "></script>
<script src="<?= assets('/public/admin-panel/js/mdb.min.js') ?> "></script>
<script src="<?= assets('/public/ckeditor/ckeditor.js') ?>"></script>

<script>
    $(document).ready(function (){
        CKEDITOR.replace("body");
        CKEDITOR.replace('summary')

    });
</script>

</body>

</html>