<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_layout/header', $title);
?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= isset($project) ? 'Edit Project' : 'Add Project' ?></h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-stretch justify-content-between">
                            <h4>Project Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo isset($project) ? site_url('Dashboard/edit_project') : site_url('Dashboard/add_project'); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo isset($project['id']) ? $project['id'] : ''; ?>">

                                <label for="projectName">Project Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($project['projectName']) ? $project['projectName'] : ''; ?>" name="projectName" id="projectName" required>
                                </div>

                                <label for="clientName">Client Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($project['clientName']) ? $project['clientName'] : ''; ?>" name="clientName" id="clientName" required>
                                </div>

                                <label for="projectLeader">Project Leader</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($project['projectLeader']) ? $project['projectLeader'] : ''; ?>" name="projectLeader" id="projectLeader" required>
                                </div>

                                <label for="startDate">Start Date</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" value="<?php echo isset($project['startDate']) ? $project['startDate'] : ''; ?>" name="startDate" id="startDate" required>
                                </div>

                                <label for="endDate">End Date</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" value="<?php echo isset($project['endDate']) ?  $project['endDate'] : ''; ?>" name="endDate" id="endDate" required>
                                </div>


                                <div class="form-group">
                                    <label for="projectDetail">Project Detail</label>
                                    <textarea type="text" class="form-control" name="projectDetail" id="projectDetail" required><?php echo isset($project['projectDetail']) ? $project['projectDetail'] : ''; ?></textarea>
                                </div>


                                <div class="form-group">
                                    <?php if (!empty($locations)): ?>
                                        <?php foreach ($locations as $location): ?>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="locations[]" value="<?php echo $location['id']; ?>" id="location_<?php echo $location['id']; ?>" 
                                                <?php 
                                                echo isset($project['locations']) ? in_array($location, $project['locations']) ? 'checked' : '' : '';                                                
                                                ?>
                                                >
                                                <label class="form-check-label" for="location_<?php echo $location['id']; ?>">
                                                    <?php echo $location['locationName']; ?>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>No locations available.</p>
                                    <?php endif; ?>
                                </div>

                                <input class="btn btn-primary" type="submit" value="<?= isset($project) ? 'Edit Project' : 'Add Project' ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>



<?php $this->load->view('_layout/footer'); ?>