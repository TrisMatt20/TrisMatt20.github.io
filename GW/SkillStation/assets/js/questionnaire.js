var questionCount = 1;

function addQuestion() {
    var questionsContainer = document.getElementById("questionsContainer");

    var questionInput = document.getElementsByName(`question${questionCount}`)[0];

    if (!questionInput) {
        questionsContainer.insertAdjacentHTML("beforeend", createQuestionCard(questionCount));
    } else {
        if (!questionInput.value) {
            alert("Please fill in the question before adding a new one.");
        } else {
            questionCount++;
            questionsContainer.insertAdjacentHTML("beforeend", createQuestionCard(questionCount))
        }
    }
}

function createQuestionCard(questionCount) {
    return `
    <div class="card bg-light p-3 my-2">
        <div class="row">
            <div class="form-label fw-medium m-0">Question ${questionCount}</div>

            <div class="col-12 d-flex flex-column flex-md-row align-items-start align-items-md-center gap-1 my-1">
                <input class="form-control" type="text" placeholder="Enter Question" name="question${questionCount}">

                <div class="form-check ms-md-2">
                    <input class="form-check-input" type="checkbox" id="chkQuestion${questionCount}" name="question${questionCount}Required">
                    <label class="form-check-label" for="chkQuestion${questionCount}">Required</label>
                </div>
            </div>
        </div>
    </div>
    `;
}


