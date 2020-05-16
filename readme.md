Описание приложения:

Один ключ апи имеет возможность создать лишь один университет

Университет
- Получить информацию о нём '/university/{api}'
- Создать '/university/create/{api}/{full_name}/{short_name}'
- Удалить '/university/delete/{api}'g
- Переименовать '/university/rename/{api}/{full_name}/{short_name}'

Факультет
- Получить все факультеты '/faculties/{api}'
- Создать факультет '/faculty/create/{api}/{full_name}/{short_name}'
- Удалить факультет '/faculty/delete/{api}/{id_faculty}'
- Переименовать '/faculty/rename/{api}/{id}/{full_name}/{short_name}'

Департамент
- Получить все департаменты '/department/{api}'
- Создать департамент '/department/create/{api}/{faculty_id}/{full_name}/{short_name}'
- Удалить департамент '/department/delete/{api}/{id}'
- Переименовать департамент '/department/rename/{api}/{id}/{full_name}/{short_name}'

Типы
- Получить все типы '/types/{api}'
- Создать тип '/type/create/{api}/{full_name}/{short_name}'
- Удалить тип '/type/delete/{api}/{id}'
- Переименовать тип '/type/rename/{api}/{id}/{full_name}/{short_name}'

Аудитории
- Получить все аудитории '/auditories/{api}'
- Создать аудиторию '/auditory/create/{api}/{name}'
- Удалить аудиторию '/auditory/delete/{api}/{id}'
- Переименовать аудиторию '/auditory/rename/{api}/{id}/{name}'

Преподаватели
- Получить всех преподавателей '/teachers/{api}'
- Создать преподавателя '/teacher/create/{api}/{full_name}/{short_name}/{department_id}'
- Удалить преподавателя '/teacher/delete/{api}/{id}'
- Переименовать преподавателя '/teacher/rename/{api}/{id}/{full_name}/{short_name}'

Время начала и окончания пар
Формат времени H:m:s
- Получить время начала и окончания всех пар '/time/{api}'
- Создать время начала и окончания пары '/time/create/{api}/{time_start}/{time_end}'
- Удалить время начала и окончания пары '/time/delete/{api}/{id}' 

Группы:
- Получить все группы '/groups/{api}'
- Создать группу '/group/create/{api}/{name}/{faculty_id}'
- Удалить группу '/group/delete/{api}/{id}'
- Переименовать группу '/group/rename/{api}/{id}/{name}'

Предметы:
- Получить все предметы '/subjects/{api}'
- Создать предмет '/subject/create/{api}/{full_name}/{short_name}'
- Удалить предмет '/subject/delete/{api}/{id}'
- Переименовать предмет '/subject/rename/{api}/{id}/{full_name}/{short_name}'

Расписание:
Формат даты Y-m-d 
- Получить все занятия (всё в id) '/classes/{api}'
- Создать занятие '/class/create/{api}/{subject_id}/{auditory_id}/{class_time_id}/{group_id}/{teacher_id}/{type_id}/{date}' тут формат даты Y-m-d, d.m.Y
- Удалить занятие '/class/delete/{api}/{id}'


Ошибки:
api404 - Api ключ не найден
api0 - Api ключ уже имеет университет
api1 - Api не имеет университетов
api2 - Несуществующий факультет
api3 - Несуществующий департамент
api4 - Несуществующий тип
api5 - Несуществующая аудитория
api6 - Несуществующий преподаватель
api7 - Несуществующее время
api8 - Несуществующая группа
api9 - Несуществующий предмет
api10 - Несуществующее занятие