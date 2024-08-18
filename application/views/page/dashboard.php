<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_layout/header', $title);
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Project</h1>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header d-flex align-items-stretch justify-content-between">
              <h4>Project List</h4>
              <a href="<?php echo site_url('project/add-project'); ?>" class="btn btn-primary d-flex rounded align-items-center">Add Project</a>
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
                        <th>Project Name</th>
                        <th>Client Name</th>
                        <th>Project Leader</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Project Detail</th>
                        <th>Location</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1 ?>
                      <?php foreach ($projects as $project): ?>
                        <tr>
                          <td>
                            <?php
                            echo $i;
                            $i++;
                            ?>
                          </td>
                          <td><?= $project['projectName'] ?></td>
                          <td><?= $project['clientName'] ?></td>
                          <td><?= $project['projectLeader'] ?></td>
                          <td><?= $project['startDate'] ?></td>
                          <td><?= $project['endDate'] ?></td>
                          <td><?= $project['projectDetail'] ?></td>

                          <td>
                            <ul class="m-0 p-3">
                              <?php foreach ($project['locations'] as $location): ?>
                                <li>
                                  <?= $location['locationName'] . ' ' . '(' . $location['country'] . ')' ?>
                                </li>
                              <?php endforeach; ?>
                            </ul>
                          </td>
                          <td>
                            <a href="<?php echo site_url('project/edit-project/' . $project['id']); ?>" class="btn btn-warning">Edit</a>
                            <button class="btn btn-danger" data-toggle="modal" data-target="#confirmModal" data-id="<?php echo $project['id']; ?>">Delete</button>
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
                <form id="deleteForm" action="<?php echo site_url('Dashboard/delete_project'); ?>" method="post">
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
    $('#confirmModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); 
        var locationId = button.data('id'); 
        var modal = $(this);
        modal.find('#deleteId').val(locationId);
    });
</script>
<?php $this->load->view('_layout/footer'); ?>