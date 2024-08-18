<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_layout/header', $title);

?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Location</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-stretch justify-content-between">
                            <h4>Location List</h4>
                            <a href="<?php echo site_url('location/add-location'); ?>" class="btn btn-primary d-flex rounded align-items-center">Add Location</a>
                        </div>
                        <div class="card-body">
                            <?php if ($error): ?>
                                <div style="color: red;">
                                    <strong>Error:</strong> <?php echo $error; ?>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Location Name</th>
                                                <th>Country</th>
                                                <th>City</th>
                                                <th>Province</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                            <?php foreach ($locations as $location): ?>
                                                <tr>
                                                    <td>
                                                        <?php
                                                        echo $i;
                                                        $i++;
                                                        ?>
                                                    </td>
                                                    <td><?= $location['locationName'] ?></td>
                                                    <td><?= $location['country'] ?></td>
                                                    <td><?= $location['province'] ?></td>
                                                    <td><?= $location['city'] ?></td>
                                                    <td>
                                                        <a href="<?php echo site_url('location/edit-location/' . $location['id']); ?>" class="btn btn-warning">Edit</a>
                                                        <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $location['id']; ?>">Delete</button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this location? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteForm" action="<?php echo site_url('Location/delete_location'); ?>" method="post">
                    <input type="hidden" name="id" id="deleteId">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Update modal with the location ID
    $('#confirmModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var locationId = button.data('id'); // Extract info from data-* attributes
        var modal = $(this);
        modal.find('#deleteId').val(locationId);
    });
</script>

<?php $this->load->view('_layout/footer'); ?>