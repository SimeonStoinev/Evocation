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
            var listenerID = data.listenerID;
            var lessonID = parseInt(data.lessonID);
            var students = data.studentsData;
            $('#openListener').after('<button id="closeListener" class="btn btn-outline-primary small-btn" onclick="closeCheckinListener(' + listenerID + ', ' + lessonID + ')">Затвори чекиране</button>');
            $('#openListener').remove();
            $('#closeListener').after('<ul class="lessonStudents"></ul>');
            $(students).each(function () {
                var items = this;
                $.each(items, function () {
                    if (this.checked) {
                        var studentColor = 'green';
                    } else {
                        var studentColor = 'red';
                    }

                    $('<li style="color: ' + studentColor + ';">'+this.studentName+'</li>').appendTo($('.lessonStudents:last'));
                })
            });

            setTimeout(function () { refreshCheckedUsers(listenerID) }, 8000);
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

// Chained after opening the checkin listener so it can refresh the users when they start to checkin
function refreshCheckedUsers (listenerID) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "checkins/refreshCheckedUsers",
        type: "POST",
        data: {
            listenerID: listenerID
        },
        success: function (data) {
            var listenerID = data.listenerID;
            var students = data.studentsData;

            $('.lessonStudents:last').empty();

            $(students).each(function () {
                var items = this;
                $.each(items, function () {
                    if (this.checked) {
                        var studentColor = 'green';
                    } else {
                        var studentColor = 'red';
                    }

                    $('<li style="color: ' + studentColor + ';">'+this.studentName+'</li>').appendTo($('.lessonStudents:last'));
                })
            });

            setTimeout(function () { refreshCheckedUsers(listenerID) }, 5000);
        }
    });
}

function displayHomeContent (el) {
    $('li.active').removeClass('active');
    $(el).parent().addClass('active');
    var contentElement = $('div[content='+el.attr('data-content')+']');
    $(contentElement).siblings('div').fadeOut(300);
    $(contentElement).fadeIn(300);
    var menuTitle = $(el).parent().parent().siblings('a').find('.title').html();
    $('.card-header').html(menuTitle);
    //console.log(menuTitle);
    //setTimeout(function(){$(contentElement).fadeIn(300)}, 300);
}