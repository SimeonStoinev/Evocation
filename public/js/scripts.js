// Function used to display the grades select, depending on the school and on rank selected - triggered from school select
function schoolRegisterForm (selectEl, grades) {
    var optionValue = $(selectEl).children("option:selected").val();

    if ($('#rank').val() === 'student' && grades[optionValue] !== undefined) {
        $('#grade').empty().append("<option value='" + 0 + "'>Изберете клас:</option>");

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
        url: "/checkins",
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
        url: "/checkins/close",
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

// Function used to excuse an absence of a student by a classteacher, AJAX request
function excuseAbsenceByClassteacher (absenceID) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "absence/excuseByClassteacher",
        type: "POST",
        data: {
            absenceID: absenceID
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

// Method that takes care of switching between different menu sections in all home pages (except for Admin's one)
function displayHomeContent (el) {
    $('li.active').removeClass('active');
    $(el).parent().addClass('active');
    var contentElement = $('div[content='+el.attr('data-content')+']');
    $(contentElement).siblings('div').fadeOut(0);
    $(contentElement).fadeIn(300);
    var menuTitle = $(el).parent().parent().siblings('a').find('.title').html();
    $('.card-header').html(menuTitle);

    $.ajax({
        url: "/home/putSession",
        type: "POST",
        data: {
            sessionValue: el.attr('data-content'),
            cardHeader: $(el).parent().parent().siblings('a').find('.title').html()
        }
    });
}

// Closes admin modals
function closeModal () {
    $('#uglipop_overlay_wrapper').fadeOut(0);
    $('#uglipop_overlay').fadeOut(0);
    $('#uglipop_content_fixed').fadeOut(0);
}

// Pops admin modal for editing a record
function modalEdit (el, id) {
    uglipop({
        class:'modalWrapper',
        source:'div',
        content:'editRecord'
    });
    var val = $(el).prev().html();

    $('.modalWrapper').find('input[name=title]').html(val).attr('value', val).focus();
    $('.modalWrapper').find('button').attr('data-id', id);
}

// Pops admin modal for creating a record
function modalCreate () {
    uglipop({
        class:'modalWrapper',
        source:'div',
        content:'createRecord'
    });

    $('.modalWrapper').find('input').focus();
}

// Pops admin modal for deleting a record
function modalDelete (id) {
    uglipop({
        class:'modalWrapper',
        source:'div',
        content:'deleteRecord'
    });

    $('.modalWrapper').find('.btn-success').attr('data-id', id);
}

// Used in admin panel modules to edit a record; Works only for schools and subjects!
function editRecord (el) {
    let recordID = $(el).attr('data-id');
    let title = escapeString(el.siblings('input[name=title]').val().trim());
    let module = $(el).siblings('.module').val();

    if (title !== '' && title !== undefined && title !== null) {
        $.ajax({
            url: "/admin/"+module+"/update",
            type: "POST",
            data: {
                recordID: recordID,
                title: title
            },
            success: function () {
                location.reload();
            }
        });
    }
}

// Used in admin panel modules to create a record; Works only for schools and subjects!
function createRecord (el) {
    let title = escapeString(el.siblings('input[name=title]').val().trim());
    let module = $(el).siblings('.module').val();

    if (title !== '' && title !== undefined && title !== null) {
        $.ajax({
            url: "/admin/"+module+"",
            type: "POST",
            data: {
                title: title
            },
            success: function () {
                location.reload();
            }
        });
    }
}

// Used in admin panel modules to delete a record; Works only for schools and subjects!
function deleteRecord (el) {
    let module = $(el).siblings('.module').val();

    $.ajax({
        url: "/admin/"+module+"/destroy",
        type: "POST",
        data: {
            recordID: $(el).attr('data-id')
        },
        success: function () {
            location.reload();
        }
    });
}

// Escapes string's dangerous symbols
function escapeString (string) {
    const entityMap = {
        '?': '',
        '<': '',
        '>': '',
        ';': '',
    };

    return String(string).replace(/[?<>;]/g, function (s) {
        return entityMap[s];
    });
}

// Displays and hides the unexcused absences section with an animate.css effect
$('.displayAbsences').on('click', function () {
    var absencesDetailsEl = $(this).parent().parent().next();

    if (absencesDetailsEl.hasClass('animated')) {
        $(this).html('Неизвинени');

        $(absencesDetailsEl).removeClass('fadeInUp').addClass('fadeOutDown').fadeOut(800);
        setTimeout(function () {
            $(absencesDetailsEl).removeClass('animated fadeOutDown');
        }, 1000);
    } else {
        $(this).html('Скрий неизвинени');

        $(absencesDetailsEl).addClass('animated fadeInUp').fadeIn(0);
    }
});

// Displays and hides the excused absences section with an animate.css effect
$('.displayExcusedAbsences').on('click', function () {
    var absencesDetailsEl = $(this).parent().parent().next().next();

    if (absencesDetailsEl.hasClass('animated')) {
        $(this).html('Извинени');

        $(absencesDetailsEl).removeClass('fadeInUp').addClass('fadeOutDown').fadeOut(800);
        setTimeout(function () {
            $(absencesDetailsEl).removeClass('animated fadeOutDown');
        }, 1000);
    } else {
        $(this).html('Скрий извинени');

        $(absencesDetailsEl).addClass('animated fadeInUp').fadeIn(0);
    }
});



/*
    |--------------------------------------------------------------------------
    | Admin Section of functions
    |--------------------------------------------------------------------------
    |
    | All functions that follow from now on are used in the admin panel
    | and/or are helping ones for the admin modules.
    |
*/



// Applies the per page filter in the admin panel
function applyPerPage (el, module) {
    location.href = '/admin/' + module + '/' + $(el).val();
}

// Decides if the select is on teacher value and displays the classteacher select
$('#userFormRank').change(function () {
    if ($(this).val() === 'teacher') {
        $('#userFormClassteacher').children('option').attr('selected', false);
        $('#userFormClassteacher').children('option:first').attr('selected', true);
        $('.classteacher').fadeIn(300);
    } else {
        $('#userFormClassteacher').children('option:first').attr('selected', true);
        $('.classteacher').fadeOut(300);
    }

    if ($(this).val() === 'parent') {
        $('#userFormSchool').children('option').attr('selected', false);
        $('#userFormSchool').children('option:first').attr('selected', true);
        $('.school').fadeOut(300);
        $('.grade').fadeOut(300);
    } else {
        $('#userFormSchool').children('option:first').attr('selected', true);
        $('.school').fadeIn(300);
    }

    displayGradeSelect();
});

$('#userFormSchool').change(function () {
    displayGradeSelect();
});

$('#userFormClassteacher').change(function(){
    displayGradeSelect();
});

// Function called on change event to user form selects and displaying all needed resources in the form depending on the value
function displayGradeSelect () {
    if ( ($('#userFormRank').val() === 'student' && $('#userFormSchool').val() !== '0') || ($('#userFormClassteacher').val() === '1' && $('#userFormSchool').val() !== '0') ) {
        $('.grade').fadeIn(300);

        $.ajax({
            url: "/admin/getGradesBySchool",
            type: "POST",
            data:{
                schoolID: $('#userFormSchool').val()
            },
            success: function(data){
                $('#userFormGrade').empty().fadeIn(300).append("<option value='" + 0 + "'>Изберете клас:</option>");

                $(data).each(function () {
                    $('#userFormGrade').children('option:last').after(
                        "<option value='" + $(this)[0].id + "'>" + $(this)[0].title + "</option>"
                    );
                });
            }
        });
    } else {
        $('.grade').fadeOut(300);
    }
}

// Binds on change event to the curriculumFormSchool select and if it's value is different than 0, display all resources in the form
$('#curriculumFormSchool').change(function () {
    if ($('#curriculumFormSchool').val() !== '0') {
        $('.grade').fadeIn(300);
        $('#lessons').fadeIn(300);

        $.ajax({
            url: "/admin/getGradesAndTeachers",
            type: "POST",
            data:{
                schoolID: $('#curriculumFormSchool').val()
            },
            success: function(data){
                $('#curriculumFormGrade').empty().fadeIn(300).append("<option value='" + 0 + "'>Изберете клас:</option>");

                $(data[0]).each(function () {
                    $('#curriculumFormGrade').children('option:last').after(
                        "<option value='" + $(this)[0].id + "'>" + $(this)[0].title + "</option>"
                    );
                });

                $('.teachers').each(function () {
                    const teacherSelect = this;

                    $(teacherSelect).empty().append("<option value='" + 0 + "'>Изберете преподавател:</option>");
                    $(data[1]).each(function () {
                        $(teacherSelect).children('option:last').after(
                            "<option value='" + $(this)[0].id + "'>" + $(this)[0].name + ' ' + $(this)[0].family + "</option>"
                        );
                    });
                });
            }
        });
    } else {
        $('.grade').fadeOut(300);
        $('#lessons').fadeOut(300);
        $('.curriculumFormGrade').empty().fadeOut(300).append("<option value='" + 0 + "'>Изберете клас:</option>");
    }
});

// Adds a curriculum lesson form block in the admin panel
function addFormLesson (el) {
    const lastLesson = $(el).prev();
    const lastLessonNumber = $(lastLesson).find('p').html().split(' ');

    $(lastLesson).after('<div class="singleFormLesson" style="display: none;">' + $(lastLesson).html() + '</div>');
    $(lastLesson).next().find('p').html('Час номер ' + (parseInt(lastLessonNumber[2]) + 1) );
    $(lastLesson).next().find('.deleteLessonBtn').removeAttr('disabled');
    $(lastLesson).next().fadeIn(300);
    //console.log($('.singleFormLesson:last'));
}

// Removes a curriculum lesson form block in the admin panel
function deleteFormLesson (el) {
    $(el).parent().remove();
}