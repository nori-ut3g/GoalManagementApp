## 概要
LaravelとVue.jsで作成した、Todoリストです。

同じような目標を持つ人に、目標とタスクをシェアできます。
詳細は、

をご確認ください。

## 仕様技術
Docker
Laravel
Vue.js

## 


## APIエンドポイント
将来的にモバイルアプリケーション、デスクトップアプリケーションに拡張するため、
APIのエンドポイントは以下のように設定しました。（後々APIトークン認証）
なお、現時点ではクッキー認証にしか対応していません。

| TH                             | メソッド | URI           | 認証 |
|--------------------------------|------|---------------|---|
| [ユーザー登録する](README/register.md) | POST | /api/register | TD |
| [ログインする](README/login.md)      | POST | /api/login            | TD |
| [ログアウトする](README/logout.md)    | GET  | /api/logout            | TD |

| TH                                               | メソッド   | URI           | 認証 |
|--------------------------------------------------|--------|---------------|---|
| [ユーザーの名前を変更する](README/update-user_name.md)       | PUT    | /api/user/update_name | TD |
| [ユーザーのメールアドレスを変更する](README/update-user_email.md) | PUT    | /api/user/update_email            | TD |
| [ユーザーのパスワードを変更する](README/update-user_pass.md)    | PUT    | /api/user/update_pass            | TD |
| [ユーザーデータをすべて削除する](README/delete-user.md)         | DELETE | /api/delete            | TD |

| TH                                               | メソッド | URI           | 認証 |
|--------------------------------------------------|------|---------------|---|
| [シェア用の目標を１つ取得する](README/get-shared_objective.md) | GET  | /api/sharedObjective/{shared_objective_id} | TD |
| [シェア用のタスクをすべて取得する](README/get-shared_tasks.md)   | GET  | /api/sharedObjective/{shared_objective_id}/tasks            | TD |

| TH                                        | メソッド   | URI                                   | 認証 |
|-------------------------------------------|--------|---------------------------------------|---|
| [目標をすべて取得する](README/get-objectives.md)    | GET    | /api/objectives                       | TD |
| [目標をすべて削除する](README/delete-objectives.md) | DELETE | /api/objectives/delete                | TD |
| [目標を1つ削除する](README/delete-objective.md)   | DELETE | /api/objectives/delete                | TD |
| [目標を１つ取得する](README/get-objective.md)      | GET    | /api/objectives/{objective_id}        | TD |
| [目標を作成する](README/create-objective.md)     | POST   | /api/objectives/create   | TD |
| [目標を達成する](README/finish-objective.md)     | GET    | /api/objectives/{objective_id}/finish              | TD |



| TH                                          | メソッド   |  URI | 認証 |
|---------------------------------------------|--------| --- |---|
| [タスクをすべて取得する](README/get-tasks.md)          | GET    |  /api/objective/{objective_id}/tasks | TD |
| [タスクを新規作成する](README/create-task.md)         | POST   |  /api/objective/{objective_id}/task/create | TD |
| [タスクのタイトルを変更する](README/edit-task_title.md)  | PUT    |  /api/objective/{objective_id}/task/{id}/edit_title | TD |
| [タスクの内容を変更する](README/edit-task_note.md)     | PUT    |  /api/objective/{objective_id}/task/{id}/edit_note | TD |
| [タスクを開始する](README/start-task.md)            | GET    |  /api/objective/{objective_id}/task/{id}/start | TD |
| [タスクを完了する](README/finish-task.md)           | GET    |  /api/objective/{objective_id}/task/{id}/finish | TD |
| [タスクを開始を元に戻す](README/undo_start-task.md)    | GET    |  /api/objective/{objective_id}/task/{id}/undo_start | TD |
| [タスクを完了を元に戻す](README/undo_finis-task.md)    | GET    |  /api/objective/{objective_id}/task/{id}/undo_finish | TD |
| [タスクを1つ削除する](README/delete-task.md)         | DELETE |  /api/objective/{objective_id}/task/{id}/delete | TD |
| [タスクの開始日を変更する](README/update-start_date.md) | PUT    |  /api/objective/{objective_id}/task/{id}/start | TD |
| [タスクを完了日を変更する](README/update-end_date.md)   | PUT    |  /api/objective/{objective_id}/task/{id}/finish | TD |


| TH                                           | メソッド   |  URI | 認証 |
|----------------------------------------------|--------| --- |---|
| [目標をPublicにする](README/share-objective.md)    | POST   |  /api/objectives/share | TD |
| [目標をPrivateにする](README/private-objective.md) | DELETE |  /api/objectives/private/{objective_id} | TD |




タイトル変更
内容変更
はPut
