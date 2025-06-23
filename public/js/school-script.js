document.addEventListener("DOMContentLoaded", () => {
  setupSearch();
  // setupForms();
  renderMaterialTypes();
});

// function setupSearch() {
//   const search = document.getElementById("searchBox");
//   if (search) {
//     search.addEventListener("input", function (e) {
//       const filter = e.target.value.toLowerCase();
//       const rows = document.querySelectorAll("#subjectTable tr");
//       rows.forEach(row => {
//         row.style.display = row.innerText.toLowerCase().includes(filter) ? "" : "none";
//       });
//     });
//   }
// }

function setupForms() {
  const subjectForm = document.getElementById("subjectForm");
  if (subjectForm) {
    subjectForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const name = document.getElementById('subjectName').value;
      const code = document.getElementById('subjectCode').value;
      const desc = document.getElementById('subjectDescription').value;
      if (!name || !code || !desc) return alert("Please fill in all fields.");
      alert(`Subject created: ${name} (${code})`);
    });
  }
  // Handle upload box click to open file input
const uploadBox = document.getElementById("uploadBox");
const fileInput = document.getElementById("photoInput");

if (uploadBox && fileInput) {
  uploadBox.addEventListener("click", () => fileInput.click());

  fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
      uploadBox.textContent = `Selected: ${fileInput.files[0].name}`;
    }
  });
}


  const lessonForm = document.getElementById("lessonMaterialForm");
  if (lessonForm) {
    lessonForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const types = Array.from(document.querySelectorAll("#materialTypes input[type='checkbox']:checked"))
        .map(el => el.nextSibling.textContent);
      alert("Saved lesson with materials: " + types.join(", "));
      lessonForm.reset();
      renderMaterialTypes();
    });
  }

  const questionForm = document.getElementById("questionForm");
  if (questionForm) {
    questionForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const question = document.getElementById("questionText").value;
      const answers = Array.from(document.querySelectorAll(".answer-input")).map(el => el.value);
      const correct = document.querySelector("input[name='correctAnswer']:checked");
      if (!question || answers.some(ans => !ans)) return alert("Please fill in all answers.");
      if (!correct) return alert("Select the correct answer.");
      alert("Question added successfully!");
      questionForm.reset();
    });
  }

  const examForm = document.getElementById("examForm");
  if (examForm) {
    examForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const selected = Array.from(document.querySelectorAll("#examQuestions input:checked")).map(q => q.value);
      if (!selected.length) return alert("Select at least one question.");
      alert("Exam submitted with:\n" + selected.join("\n"));
      examForm.reset();
      document.getElementById("examQuestions").innerHTML = '';
      addExamQuestion(); addExamQuestion();
    });
  }
}

function createNewSubject() {
  alert("Redirecting to Add Subject...");
}
function createNewQuestion() {
  alert("Redirecting to Add New Question form...");
}
function createNewExam() {
  alert("Redirecting to Add New Exam form...");
}
function addAnswer() {
  const wrapper = document.getElementById("answersWrapper");
  const count = wrapper.querySelectorAll(".answer").length;
  const div = document.createElement("div");
  div.className = "answer";
  div.innerHTML = `
    <input type="radio" name="correctAnswer" value="${count}" />
    <input type="text" class="answer-input" placeholder="Answer ${count + 1}" />
  `;
  wrapper.insertBefore(div, wrapper.querySelector(".add-answer-btn"));
}
function addExamQuestion() {
  const container = document.getElementById("examQuestions");
  const count = container.querySelectorAll(".exam-question").length + 1;
  const wrapper = document.createElement("div");
  wrapper.className = "exam-question";
  wrapper.innerHTML = `
    <input type="checkbox" id="q${count}" value="Question ${count}" />
    <label for="q${count}">Question ${count}</label>
  `;
  container.appendChild(wrapper);
}
function renderMaterialTypes() {
  const data = [
    { type: "Video", icon: "🎥" },
    { type: "PDF", icon: "📄" },
    { type: "Assignment", icon: "📋" }
  ];
  const container = document.getElementById("materialTypes");
  if (!container) return;
  container.innerHTML = "";
  data.forEach((item, i) => {
    const div = document.createElement("div");
    div.className = "material-item";
    div.innerHTML = `
      <input type="checkbox" id="material-${i}" checked />
      <label for="material-${i}">${item.type}</label>
      <i>${item.icon}</i>
      <i onclick="this.parentElement.remove()">➖</i>
    `;
    container.appendChild(div);
  });
}
function addAnswer() {
  const wrapper = document.getElementById("answersWrapper");
  const count = wrapper.querySelectorAll(".answer").length;
  const div = document.createElement("div");
  div.className = "answer";
  div.innerHTML = `
    <input type="radio" name="correctAnswer" />
    <input type="text" class="answer-input" placeholder="Answer ${count + 1}" />
  `;
  wrapper.insertBefore(div, wrapper.querySelector(".add-answer-btn"));
}
function addCheckboxQuestion() {
  const container = document.getElementById("checkboxQuestions");
  const count = container.querySelectorAll(".exam-question").length + 1;

  const wrapper = document.createElement("div");
  wrapper.className = "exam-question";
  wrapper.innerHTML = `
    <input type="checkbox" id="q${count}" value="Question ${count}" />
    <label for="q${count}">Question ${count}</label>
  `;
  container.appendChild(wrapper);
}

const editExamQuestionForm = document.getElementById("editExamQuestionForm");
if (editExamQuestionForm) {
  editExamQuestionForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const selected = Array.from(document.querySelectorAll("#checkboxQuestions input:checked"))
      .map(q => q.value);

    if (!selected.length) {
      alert("Please select at least one question.");
      return;
    }

    alert("Exam updated with:\n" + selected.join("\n"));
  });
}


function goToAddSubjectPage() {
  window.location.href = "new subject.html";
}

function goToAddLessonMaterialPage() {
  window.location.href = "addLessonMatrial.html";
}

function goToCreateNewQuestion() {
  window.location.href = "addQuestion.html";
}
function goToCreateNewExam() {
  window.location.href = "addExam.html";
}

