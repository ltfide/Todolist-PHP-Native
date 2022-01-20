<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title><?= $model["title"] ?? "My Todolist" ?></title>
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/fontawesome/css/all.css" />
  </head>
  <body>
    <section class="vh-100 gradient-custom">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-xl-5">
          <?php if (isset($model["error"])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $model["error"] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <?php if (isset($model["success"])) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $model["success"] ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
            <div class="card">
              <div class="card-body p-5">
                <form class="d-flex justify-content-center align-items-center mb-4" action="/" method="POST">
                  <div class="form-outline flex-fill" id="add">
                    <input type="text" id="form2" name="task" placeholder="New Task.." autocomplete="off" autofocus/>
                  </div>
                  <button type="submit" name="submit" class="btn btn-info text-white ms-2">Add</button>
                </form>

                <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-4 pb-2" id="ex1" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" role="tab" aria-controls="ex1-tabs-1" aria-selected="true">All</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-2" data-mdb-toggle="tab" role="tab" aria-controls="ex1-tabs-2" aria-selected="false">Active</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Completed</a>
                  </li>
                </ul>
                <!-- Tabs navs -->

                <!-- Tabs content -->
                <div class="tab-content" id="ex1-content">
                  <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <ul class="list-group mb-0">
                      <?php if (count($model["user"]["data"]) == 0) : ?>
                        <li class="list-group-item border-0 mb-2 rounded" style="background-color: #f4f6f7">
                        <div class="text-center text-danger">
                          <div class="coret">No Task Yet</div>
                        </div>
                      </li>
                      <?php else : ?>  
                      <?php foreach ($model["user"]["data"] as $row) : ?>
                      <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded" style="background-color: #f4f6f7">
                        <input class="form-check-input me-2" type="checkbox" value=""  aria-label="..." id="cekbox" />
                          <!-- <form class="d-flex w-100 justify-content-between align-items-center" action="/delete/<?= $row["id"] ?>" method="POST"> -->
                          <div class="d-flex w-100 justify-content-between align-items-center">
                            <div class="coret"><?= $row["content"] ?? "" ?></div>
                            <!-- <input type="hidden" name="id" value="<?= $row['id'] ?>"> -->
                            <a href="#" data-id = "<?= $row["id"] ?>" id="deleteBtn"><i class="fas fa-trash-alt"></i></a>
                          </div>  
                          <!-- </form>   -->
                      </li>
                      <?php endforeach; ?>
                      <?php endif; ?>

                    </ul>
                  </div>
                  <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <ul class="list-group mb-0">
                      <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded" style="background-color: #f4f6f7">
                        <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                        Morbi leo risus
                      </li>
                      <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded" style="background-color: #f4f6f7">
                        <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                        Porta ac consectetur ac
                      </li>
                      <li class="list-group-item d-flex align-items-center border-0 mb-0 rounded" style="background-color: #f4f6f7">
                        <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." />
                        Vestibulum at eros
                      </li>
                    </ul>
                  </div>
                  <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    <ul class="list-group mb-0">
                      <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded" style="background-color: #f4f6f7">
                        <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." checked />
                        <s>Cras justo odio</s>
                      </li>
                      <li class="list-group-item d-flex align-items-center border-0 mb-2 rounded" style="background-color: #f4f6f7">
                        <input class="form-check-input me-2" type="checkbox" value="" aria-label="..." checked />
                        <s>Dapibus ac facilisis in</s>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- Tabs content -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <script src="/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/script.js"></script>
  </body>
</html>
