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

// Function used to make a DB record in the checkin_listeners table, AJAX request
function openCheckinListener (gradeID, studentIDs, lessonID) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/checkins/",
        type: "POST",
        data:{
            gradeID: gradeID,
            studentIDs: studentIDs,
            lessonID: lessonID
        },
        success: function(data){
            location.reload();
        }
    });
}

// Function used to close checkin listener and make absence records for every student that haven't checked himself, AJAX request
function closeCheckinListener (listenerID, lessonID) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/checkins/close/",
        type: "POST",
        data: {
            listenerID: listenerID,
            lessonID: lessonID
        },
        success: function (data) {
            location.reload();
        }
    });
}

// Function used to excuse an absence of a student, AJAX request
function excuseAbsence (lessonID, studentID) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "absence/excuse",
        type: "POST",
        data: {
            lessonID: lessonID,
            studentID: studentID
        },
        success: function (data) {
            location.reload();
        }
    });
}

// Function used to write an absence of a student (kick), AJAX request
function writeAbsence (lessonID, studentID) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "absence/write",
        type: "POST",
        data: {
            lessonID: lessonID,
            studentID: studentID
        },
        success: function (data) {
            location.reload();
        }
    });
}

if ($('#closeListener').length) {
    setInterval(function () {
        location.reload();
    }, 10000);
}