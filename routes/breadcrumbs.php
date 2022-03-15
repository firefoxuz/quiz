<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Bosh sahifa', route('home'));
});


Breadcrumbs::for('quiz', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Quiz', route('quizzes.index'));
});

Breadcrumbs::for('quiz_question', function (BreadcrumbTrail $trail, $quiz) {
    $trail->parent('quiz');
    $trail->push('Savollar', route('quizzes.show', ['quiz' => $quiz]));
});

Breadcrumbs::for('quiz_answer', function (BreadcrumbTrail $trail, $quiz, $question) {
    $trail->parent('quiz_question', $quiz);
    $trail->push('Javoblar', route('quiz.show_question', ['quiz_id' => $quiz, 'question_id' => $question]));
});
