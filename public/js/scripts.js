// Function used to display the grades select, depending on the school and on rank selected - triggered from school select
function schoolRegisterForm (selectEl, grades) {
    var optionValue = $(selectEl).children("option:selected").val();

    if ($('#rank').val() === 'student' && grades[optionValue] !== undefined) {
        $(grades[optionValue]).each(function () {
            $('#grade').children('option:last').after(
                "<option value='" + $(this)[0].id + "'>" + $(this)[0].title + "</option>"
            );
        });

        $('#gradesWrapper').css('display', 'flex');
    } else {
        $('#gradesWrapper').fadeOut(250);
    }
}

// Function used to display the grades select, depending on the school and on rank selected - triggered from rank select
function rankRegisterForm (grades) {
    if ($('#rank').val() === 'student') {
        schoolRegisterForm($('#school'), grades)
    } else {
        $('#gradesWrapper').fadeOut(250);
    }
}