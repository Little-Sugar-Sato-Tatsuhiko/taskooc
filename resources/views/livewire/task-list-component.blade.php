<div>
    {{-- Stop trying to control. --}}
    <div class="mb-auto task-elements">
        @foreach($task_list as $task)
        <div class="card mb-3 drag-drawflow" draggable="true" data-node='{"title":"{{$task['title']}}","description":"{{$task['description']}}",  "deadline":"{{$task['deadline']}}", "member":"{{$task['member']}}"}' data-title="title">
            <div class="card-header">
                <div class="card-title">
                    <div class="row">
                        <div class="col-10 task-title">{{$task['title']}}</div>
                        <div class="col-2 text-end" x-data="{}"><i class="bi bi-trash text-danger" @click="$wire.trash('{{$task['id']}}')"></i></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                {!!nl2br($task['description'])!!}
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-4">
                        <div class="text-start">
                            {{$task['member']}}
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="text-end">
                            締切：{{$task['deadline']}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="card">
        <div class="card-header">
            <div class="card-title">タスク追加</div>
        </div>
        <div class="card-body">
            <label for="task-title" class="form-label">タスク名</label>
            <input type="text" id="task-title" class="form-control @error('task_title') is-invalid @enderror" wire:model="task_title">
            @error('task_title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
            <label for="task-member" class="form-label">担当者</label>
            <select name="" id="" class="form-control  @error('task_member') is-invalid @enderror" wire:model="task_member">
                <option value=""></option>
                <option value="Aさん">Aさん</option>
                <option value="Bさん">Bさん</option>
                <option value="Cさん">Cさん</option>
            </select>
            @error('task_member')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
            <label for="deadline" class="form-label">締切</label>
            <input type="date" id="deadline" class="form-control" wire:model="deadline">
            <label for="description" class="form-label">メモ</label>
            <textarea class="form-control" id="description" cols="30" rows="5" wire:model="description"></textarea>
        </div>
        <div class="card-footer">
            <div class="text-center">
                <button class="btn btn-success" id="add-task" wire:click="add">
                    追加
                </button>
            </div>
        </div>
    </div>

</div>