<div class="modal" id="editName" tabindex="-1" aria-labelledby="editNameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('profile/editName') ?>" method="POST">
                    <div class="from-group mb-3">
                        <label for="ModalName">Name</label>
                        <input type="text" class="form-control" id="ModalName" name="name" value="<?=  auth('name') ?? '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--EditName-->

<div class="modal" id="editEmail" tabindex="-1" aria-labelledby="editEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('profile/editEmail') ?>" method="POST">
                    <div class="from-group mb-3">
                        <label for="ModalEmail">Email</label>
                        <input type="text" class="form-control" id="ModalEmail" name="email" value="<?= auth('email') ?? '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--EditEmail-->

<div class="modal" id="editGender" tabindex="-1" aria-labelledby="editGenderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Gender</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('profile/editGender') ?>" method="POST">
                    <div class="from-group mb-3">
                        <label for="ModalGender">Gender</label>
                        <select class="form-select" id="ModalGender" name="gender">
                            <option value="" <?= isSelect(auth('gender'), '') ?> hidden>Select Gender</option>
                            <option value="Male" <?= isSelect(auth('gender'), 'male') ?>>Male</option>
                            <option value="Female" <?= isSelect(auth('gender'), 'female') ?>>Female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--EditGender-->

<div class="modal" id="editPhone" tabindex="-1" aria-labelledby="editPhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Phone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('profile/editPhone') ?>" method="POST">
                    <div class="from-group mb-3">
                        <label for="ModalPhone">Phone</label>
                        <input type="text" class="form-control" id="ModalPhone" name="phone" value="<?= auth('phone') ?? '' ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--EditPhone-->

<div class="modal" id="editPassword" tabindex="-1" aria-labelledby="editPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= route('profile/editPassword') ?>" method="POST">
                    <div class="from-group mb-3">
                        <label for="ModalPassword">Password</label>
                        <input type="password" class="form-control" id="ModalPassword" name="password" value="">
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div><!--EditPassword-->

<div class="modal" id="addAuthor" tabindex="-1" aria-labelledby="addAuthorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addAuthorForm">
                    <div class="from-group mb-3">
                        <label for="ModalAuthorName">Author Name</label>
                        <input type="text" class="form-control" id="ModalAuthorName" name="authorName" value="">
                        <p class="alert alert-danger d-none" data-error-name="authorName" id="ModalAuthorNameError"></p>
                    </div>
                    <div class="from-group mb-3">
                        <label for="ModalAuthorBio">Author Bio</label>
                        <textarea class="form-control" id="ModalAuthorBio" name="authorBio" style="resize: none;" rows="4"></textarea>
                        <p class="alert alert-danger d-none" data-error-name="authorBio" id="ModalAuthorBioError"></p>
                    </div>
                    <button type="submit" class="btn btn-success">Add</button>
                </form>
            </div>
        </div>
    </div>
</div><!--addAuthor-->

