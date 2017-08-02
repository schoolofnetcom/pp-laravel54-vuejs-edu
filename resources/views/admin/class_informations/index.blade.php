@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3>Listagem de turmas</h3>
            {!! Button::primary('Nova turma')->asLinkTo(route('admin.class_informations.create')) !!}
        </div>
        <div class="row">
            {!!
            Table::withContents($class_informations->items())
            ->striped()
            ->callback('Ações', function($field,$model){
                $linkEdit = route('admin.class_informations.edit',['class_information' => $model->id]);
                $linkShow = route('admin.class_informations.show',['class_information' => $model->id]);
                $linkStudents = route('admin.class_informations.students.index',['class_information' => $model->id]);
                $linkTeachings = route('admin.class_informations.teachings.index',['class_information' => $model->id]);
                return Button::link(Icon::create('pencil').' Editar')->asLinkTo($linkEdit).'|'.
                    Button::link(Icon::create('folder-open').'&nbsp;&nbsp;Ver')->asLinkTo($linkShow).'|'.
                    Button::link(Icon::create('home').'&nbsp;&nbsp;Alunos')->asLinkTo($linkStudents).'|'.
                    Button::link(Icon::create('blackboard').'&nbsp;&nbsp;Ensino')->asLinkTo($linkTeachings);
            })
            !!}
        </div>

        {!! $class_informations->links() !!}
    </div>
@endsection