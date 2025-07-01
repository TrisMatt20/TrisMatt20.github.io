<?php
include("backend/auth/logout.php");
include('backend/guest/attend.php');

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SkillStation</title>
    <link rel="icon" href="assets/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
</head>

<body>
    <?php include 'assets/php/navbar-guest.php'; ?>

    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="row w-100 justify-content-center">

            <div class="col-12 text-center mb-4">
                <h5 class="fw-bold" style="color: #2d3e8b; font-size: 2rem;">ATTEND EVENT</h5>
            </div>
            <div class="col-lg-7 col-md-9 col-12">
                <div class="card shadow-sm p-4 p-md-5" style="max-width: 700px; margin: 0 auto;">
                    <div class="mb-3">
                        <h6 class="fw-bold mb-1" style="color: #2d3e8b; font-size: 1.25rem;">CONTACT INFORMATION</h6>
                        <div class="d-flex justify-content-end">
                            <small class="mt-2 mt-md-0"><span style="color: #2d3e8b;">*</span> <span
                                    class="text-dark">Required</span></small>
                        </div>
                    </div>
                    <form method="POST" action="" class="d-flex flex-column gap-2 w-100">
                        <input type="hidden" name="eventID"
                            value="<?php echo htmlspecialchars(isset($_GET['eventID']) ? $_GET['eventID'] : ''); ?>">
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" class="form-control" id="firstName" name="firstName"
                                    placeholder="First Name*" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="lastName" name="lastName"
                                    placeholder="Last Name*" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Email Address*" required>
                        </div>
                        <div class="mb-2">
                            <h6 class="fw-bold mb-1" style="color: #2d3e8b;">QUESTIONNAIRE</h6>
                        </div>

                        <?php while ($eventFormRow = mysqli_fetch_assoc($eventFormResult)) { ?>
                            <div class="mb-3 p-2 bg-light border rounded">
                                <label class="form-label fw-semibold"><?php echo $eventFormRow['question'] ?></label>
                                <input type="text" class="form-control" placeholder="Enter your answer"
                                    name="question_<?php echo $eventFormRow['eventQuestionId'] ?>" <?php echo ($eventFormRow['isRequired'] == 'yes') ? 'required' : ''; ?>>
                            </div>
                        <?php
                        }
                        ?>

                        <div class="mb-2 form-check">
                            <input class="form-check-input" type="checkbox" id="updates" name="updates" required>
                            <label class="form-check-label small" for="updates">
                                Keep me updated on more events and news from this event organizer.
                            </label>
                        </div>
                        <div class="mb-2 form-check">
                            <input class="form-check-input" type="checkbox" id="sendemail" name="sendemail" required>
                            <label class="form-check-label small" for="sendemail">
                                Send me emails about the best events happening nearby or online.
                            </label>
                        </div>
                        <div class="mb-3 small">
                            By selecting Register, I agree to the <a href="#" data-bs-toggle="modal"
                                data-bs-target="#termsModal">SkillStation Terms of Service</a>.
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" name="submit" class="btn btn-primary" id="submitButton" disabled>
                                Register
                            </button>
                            <a href="index.php" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Terms of Service Modal -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
                <div class="modal-content p-3 p-md-4 position-relative" style="border-radius: 15px;">
                    <button type="button" class="btn-close position-absolute"
                        style="top: 16px; right: 16px; z-index: 2;" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header border-0 pb-0 flex-column align-items-center" style="padding-top: 24px;">
                        <h5 class="modal-title fw-bold text-primary fs-4 w-100 text-center mt-3 mb-4"
                            id="termsModalLabel">
                            SkillStation Terms of Service
                        </h5>
                    </div>
                    <div
                        class="modal-body pt-2 flex-grow-1 d-flex flex-column justify-content-start align-items-center w-100">
                        <div class="mb-3 fs-6 text-start w-100" style="max-height: 400px; overflow-y: auto;">
                            <p>
                                Welcome to SkillStation! By using our platform, you agree to the following terms and
                                conditions.
                            </p>
                            <ul>
                                <li>Use the platform responsibly and respectfully.</li>
                                <li>Your data will be handled according to our privacy policy.</li>
                                <li>Do not misuse or attempt to disrupt the service.</li>
                                <li>SkillStation reserves the right to update these terms at any time.</li>
                            </ul>
                            <p>
                                For more information, contact us at support@skillstation.com.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Section -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3 p-md-4 position-relative"
                    style="border-radius: 15px; min-height: 300px; display: flex; flex-direction: column; justify-content: flex-start;">
                    <button type="button" class="btn-close position-absolute"
                        style="top: 16px; right: 16px; z-index: 2;" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header border-0 pb-0 flex-column align-items-center" style="padding-top: 24px;">
                        <h5 class="modal-title fw-bold text-primary fs-4 w-100 text-center mt-3 mb-4"
                            id="confirmationModalLabel">
                            Your are now registered for the event!
                        </h5>
                    </div>
                    <div
                        class="modal-body pt-2 flex-grow-1 d-flex flex-column justify-content-start align-items-center w-100">
                        <div class="mb-3 fw-bold fs-5 text-center w-100"> The details has been sent to your email.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const requiredFields = [
                document.getElementById('firstName'),
                document.getElementById('lastName'),
                document.getElementById('email'),
                document.getElementById('updates'),
                document.getElementById('sendemail')
            ];
            const submitButton = document.getElementById('submitButton');

            function checkInputs() {
                const allValid = requiredFields.every(field => {
                    if (field.type === 'checkbox') {
                        return field.checked;
                    } else {
                        return field.value.trim().length > 0;
                    }
                });
                submitButton.disabled = !allValid;
            }

            requiredFields.forEach(field => {
                field.addEventListener(field.type === 'checkbox' ? 'change' : 'input', checkInputs);
            });

            checkInputs();
        });
    </script>
    <?php if (isset($successModal) && $successModal): ?>
        <script>
            window.addEventListener('DOMContentLoaded', function () {
                var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
                modal.show();
            });
        </script>
    <?php endif; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var confirmationModal = document.getElementById('confirmationModal');
            if (confirmationModal) {
                confirmationModal.addEventListener('hidden.bs.modal', function () {
                    window.location.href = 'index.php';
                });
            }
        });
    </script>
</body>

</html>