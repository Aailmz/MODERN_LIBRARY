<div class="modal fade" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <h5 class="modal-title" id="createStudentModalLabel">Add Student</h5>
                <form id="editStudentForm">
                    <div class="mb-3">
                        <label for="createName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="createName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="createEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="createPassword" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveCreatedStudent()">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <h5 class="modal-title" id="editStudentModalLabel">Edit Student</h5>
                <form id="editStudentForm">
                    <div class="mb-3">
                        <label for="editStudentName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editStudentName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editStudentEmail" name="email">
                    </div>
                    <input type="hidden" class="form-control" id="editStudentPassword" name="password">
                    <input type="hidden" id="editStudentId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveEditedStudent()">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <h5 class="modal-title" id="createEmployeeModalLabel">Add Student</h5>
                <form id="editEmployeeForm">
                    <div class="mb-3">
                        <label for="createEmployeeName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="createEmployeeName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="editEmployeeEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="createEmployeeEmail" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="editEmployeePassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="createEmployeePassword" name="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="saveCreatedEmployee()">Add</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Body -->
            <div class="modal-body">
                <h5 class="modal-title" id="editEmployeeModalLabel">Edit Student</h5>
                <form id="editEmployeeForm">
                    <div class="mb-3">
                        <label for="editStudentName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="editEmployeeName" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="editStudentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmployeeEmail" name="email">
                    </div>
                    <input type="hidden" class="form-control" id="editEmployeePassword" name="password">
                    <input type="hidden" id="editEmployeeId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveEditedEmployee()">Save changes</button>
            </div>
        </div>
    </div>
</div>