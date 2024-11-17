<?= $this->extend('layout/admin/main') ?>


<?= $this->section('content') ?>

    <h2 class="fw-bold">user data</h2>

    <div class="my-3 rounded-1 border border-primary">
        <div class="my-callout-content rounded-1">

            <div class="p-2 rounded-1"
                 style="border-left: 7px solid dodgerblue;background-color: #c8d5ef">
                <strong class="ms-3 d-block">ℹ️ info</strong>
                <div class="ps-3 ">
                    1. sample callout information
                </div>
            </div>

        </div>
    </div>

    <div class="my-5">

        <table id="userTable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>

    </div>


    <script>
        $('#userTable').DataTable({
            processing: true,
            serverSide: false,
            pageLength:10,
            ajax: {
                url: "<?= base_url('users') ?>",
                type: "GET",
                "dataSrc": function (json) {
                    return json.data;
                },
                error: function (xhr, error, code) {
                    console.error("Error:", error);
                    console.error("Code:", code);
                    console.error("Response:", xhr.responseText);
                },
            },
            "columns": [
                {
                    // increment number column
                    "data": null,
                    "render": function (data, type, row, meta) {
                        return meta.row + 1;
                    },
                },
                { "data": "email" },
                {
                    "data": "user_id",  // take id
                    "render": actionButtonsRenderer
                }
            ]
        });


        // rendered button
        function actionButtonsRenderer(data, type, row) {
            return `
        <a href="<?= base_url('edit') ?>/${data}" class="btn btn-sm btn-primary">Edit</a>
        <a href="<?= base_url('detail') ?>/${data}" class="btn btn-sm btn-info">Detail</a>
        <form id="formdelete${data}" action="<?= base_url('admin/catalogue/') ?>${data}" method="post" class="d-inline">
            <input type="hidden" name="_method" value="DELETE">
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#buttonFormDelete${data}" title="Delete">
                <i class="fa-solid fa-trash fa-sm"></i>
            </button>
        </form>

        <!-- Modal Konfirmasi delete -->
        <div class="modal fade" id="buttonFormDelete${data}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn${data}" onclick="submitDeleteForm('${data}')">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    `;
        }


        function submitDeleteForm(data) {
            const form = document.getElementById(`formdelete${data}`);
            if (form) {
                form.submit();
            }
        }
    </script>

<?= $this->endSection('content') ?>