<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('_layout/header', $title);

?>

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= isset($location) ? 'Edit Location' : 'Add Location' ?></h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-stretch justify-content-between">
                            <h4>Location Form</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo isset($location) ? site_url('Location/edit_location') : site_url('Location/create_location'); ?>" method="post">
                                <input type="hidden" name="id" value="<?php echo isset($location['id']) ? $location['id'] : ''; ?>">

                                <label for="locationName">Location Name</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($location['locationName']) ? $location['locationName'] : ''; ?>" name="locationName" id="locationName" required>
                                </div>

                                <label for="country">Country</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($location['country']) ? $location['country'] : ''; ?>" name="country" id="country" required>
                                </div>

                                <label for="province">Province</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($location['province']) ? $location['province'] : ''; ?>" name="province" id="province" required>
                                </div>

                                <label for="city">City</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" value="<?php echo isset($location['city']) ? $location['city'] : ''; ?>" name="city" id="city" required>
                                </div>

                                <input class="btn btn-primary" type="submit" value="<?= isset($location) ? 'Edit Location' : 'Add Location' ?>">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>



<?php $this->load->view('_layout/footer'); ?>