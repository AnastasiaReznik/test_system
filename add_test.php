<h1>Добавление опроса</h1>
<form method="POST" action="" id="formAddTest">
    <p>Название опроса</p>
    <input class="form-control" type="text" name="nameTest" required>

<div class="container">
    <div class="row">
        <h4 class='text-center'>Вопрос№1</h4>
        <input type="text" required name='question1' class="newQuestion">
    </div>
    <div  class="radios">  
  <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-1' class='newAnswer answ1' required>
      <input type="radio" class="form-check-input" id="" name="radio1" required>
      <!-- <input class="form-check-input" type="radio" name="answer1" id=""> -->
    </div>
  </div>
  </div>
  <div class="row" style='margin-bottom:20px'>
      
  </div>
  <div class="row">
        <h4 class='text-center'>Вопрос№2</h4>
        <input type="text" name='question2' class="newQuestion" required>
    </div>
    <div class="row">
    <div class="col-sm">
      <p>Ответ№1</p>
      <input type="text" name='answer1-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio2" required>

    </div>
    <div class="col-sm">
    <p>Ответ№2</p>
      <input type="text" name='answer2-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio2" required>
      <!-- <input class="form-check-input" type="radio" name="answer2" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№3</p>
      <input type="text" name='answer3-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio2" required>
      <!-- <input class="form-check-input" type="radio" name="answer2" id=""> -->
    </div>
    <div class="col-sm">
    <p>Ответ№4</p>
      <input type="text" name='answer4-2' class='newAnswer answ2' required>
      <input type="radio" class="form-check-input" id="validationFormCheck2" name="radio2" required>
      <!-- <input class="form-check-input" type="radio" name="answer2" id=""> -->
    </div>
</div>
    
  <div class="row-sm" style='margin-top:20px; text-align:center'>
    <button type="submit" class="btn btn-primary">Добавить</button>
  </div>
</form>

<script> 
$('#formAddTest').submit(function (e) {
    e.preventDefault();
  //назв теста
  let nameTest = $(this).parent(".container").find('input[name="nameTest"]').val(); 

  // вопросы - 5шт
  const arrQuestion = [$(this).parent(".container").find('.newQuestion')];
  // console.log(arrQuestion);

  // ответы - 20шт
  const arrAnswers = [$(this).parent(".container").find('.newAnswer')];
  console.log(arrAnswers);

  $(this).parent(".container").find('.newQuestion').each(function (ind, quest) {
    $(this).parent(".container").find('.newAnswer').each(function (index, answer) {
    // console.log($(this).val()); //ответы из инпутов

  }
  
    });

  // $.ajax({
  //             method: "POST",
  
  //             url: "ajax.php",
  
  //             data: {
  //                 successAnswer: cor,
  //                 errorAnswer: uncor,
  //                 idTest: idTest,
  //             }
  
  //         }).done(function(resp) {
  //             if (resp == false) {
  //                 alert('Ошибка.Повторите позже!');
  //             } else {
  //                 // var res = JSON.parse(resp);
  //                 console.log(resp);
  //             }
  //         })
});




//проверка выбрано ли радио-поле
// $('#formAddTest').submit(function (e) {
//     e.preventDefault();
    // console.log($(this).parent(".container").find('input[name="nameTest"]').val());  //название опроса

// })
// $('.btn').on('click', function (e) {
//     e.preventDefault();
//     var check = '';
//     var check1 = false;
//     var check2 = false;

//     $("input[name ='answer1']").each(function (index, val) {
//         check = $(this).prop("checked");
//        if (check == true) {
//             // console.log('ответ выбран');
//             check1 = check;
//             return false; //радио-кнопка выбрана
//        }
//     });

//     $("input[name ='answer2']").each(function (index, val) {
//         check = $(this).prop("checked");        
//        if (check == true) {
//             check2 = check;
//             return false; //радио-кнопка выбрана
//        }
//     });

//     if (check1 == true && check2 == true)) {
//         console.log('все ответы выбраны');
//     } else {
//         console.log('Выберите правильный вариант ответа!');
//     }
// });




</script>