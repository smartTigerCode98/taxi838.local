$( function() {
    $( "#datepicker" ).datepicker({
        monthNames: ['Січень', 'Лютий', 'Березень', 'Квітень',
            'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень',
            'Жовтень', 'Листопад', 'Грудень'],
        dayNamesMin: ['Нд','Пн','Вт','Ср','Чт','Пт','Сб'],
        firstDay: 1,
        minDate: 0,
        dateFormat: 'yy-mm-dd'


    });
    $( "#datepicker1" ).datepicker({
        monthNames: ['Січень', 'Лютий', 'Березень', 'Квітень',
            'Травень', 'Червень', 'Липень', 'Серпень', 'Вересень',
            'Жовтень', 'Листопад', 'Грудень'],
        dayNamesMin: ['Нд','Пн','Вт','Ср','Чт','Пт','Сб'],
        firstDay: 1,
        minDate: 0,
        dateFormat: 'yy-mm-dd'
    });

    $('.timepicker').wickedpicker({
        twentyFour: true,
        maxTime: '16:00',

    });
});