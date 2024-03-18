<?php
require_once BASE_PATH . '/template/admin/layouts/header.php';
?>



<section class="pt-3 pb-1 mb-2 border-bottom ">
    <h1 class="h5 ">Edit Article</h1>
</section>
<section class="row my-3 ">
    <section class="col-12 ">

        <form method="post " action=" " enctype="multipart/form-data ">
            <div class="form-group ">
                <label for="title ">Title</label>
                <input type="text " class="form-control " id="title " name="title " placeholder="Enter title ... " value=" ">
            </div>

            <div class="form-group ">
                <label for="cat_id ">Category</label>
                <select name="cat_id " id="cat_id " class="form-control " required autofocus>

                    <option value=" ">
                        ss
                    </option>

                </select>
            </div>

            <div class="form-group ">
                <img style="width: 100px; " src=" " alt=" ">
                <hr/>
                <label for="image ">Image</label>
                <input type="file " id="image " name="image " class="form-control-file " autofocus>
            </div>

            <div class="form-group ">
                <label for="published_at ">published at</label>
                <input type="text " class="form-control " id="published_at " name="published_at " required autofocus>
            </div>

            <div class="form-group ">
                <label for="summary ">summary</label>
                <textarea class="form-control " id="summary " name="summary " placeholder="summary ... " rows="3 ">ss</textarea>
            </div>
            <div class="form-group ">
                <label for="body ">body</label>
                <textarea class="form-control " id="body " name="body " placeholder="body ... " rows="5 ">sss</textarea>
            </div>
            <button type="submit " class="btn btn-primary btn-sm ">update</button>
        </form>
    </section>
</section>

<?php
require_once BASE_PATH . '/template/admin/layouts/footer.php';
?>
