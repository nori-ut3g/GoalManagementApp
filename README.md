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


### ユーザー認証
|                                | メソッド | URI           | 認証 |
|----------------------------------|------|---------------|--|
| [ユーザー登録する](README/register.md)   | POST | /api/register | 不要 |
| [ログインする](README/login.md)        | POST | /api/login    | 不要 |
| [ログアウトする](README/logout.md)      | GET  | /api/logout   | 不要 |
| [ログイン状態かチェックする](README/check.md) | GET  | /api/check    | 不要 |

### ユーザー情報の操作
|                                                  | メソッド   | URI                    | 認証  |
|--------------------------------------------------|--------|------------------------|-----|
| [ユーザー情報を取得する](README/user.md)                    | GET    | /api/user              | 必要  |
| [ユーザーの名前を変更する](README/update-user_name.md)       | PUT    | /api/user/update_name  | 必要  |
| [ユーザーのメールアドレスを変更する](README/update-user_email.md) | PUT    | /api/user/update_email | 必要  |
| [ユーザーのパスワードを変更する](README/update-user_pass.md)    | PUT    | /api/user/update_pass  | 必要  |
| [ユーザーデータをすべて削除する](README/delete-user.md)         | DELETE | /api/user/delete       | 必要  |

### シェア用
|                                                  | メソッド | URI                                              | 認証  |
|--------------------------------------------------|------|--------------------------------------------------|-----|
| [シェア用の目標を１つ取得する](README/get-shared_objective.md) | GET  | /api/sharedObjective/{shared_objective_id}       | 不要  |
| [シェア用のタスクをすべて取得する](README/get-shared_tasks.md)   | GET  | /api/sharedObjective/{shared_objective_id}/tasks | 不要  |

### 目標操作
|                                                       | メソッド   | URI                                        | 認証  |
|-------------------------------------------------------|--------|--------------------------------------------|-----|
| [目標をすべて取得する](README/get-objectives.md)                | GET    | /api/objectives                            | 必要  |
| [目標をすべて削除する](README/delete-objectives.md)             | DELETE | /api/objectives/delete                     | 必要  |
| [目標を1つ削除する](README/delete-objective.md)               | DELETE | /api/objectives/{objective_id}/delete      | 必要  |
| [目標を１つ取得する](README/get-objective.md)                  | GET    | /api/objectives/{objective_id}             | 必要  |
| [目標を作成する](README/create-objective.md)                 | POST   | /api/objectives/create                     | 必要  |
| [目標を達成する](README/finish-objective.md)                 | GET    | /api/objectives/{objective_id}/finish      | 必要  |
| [目標の達成を元に戻す](README/undo-finish-objective.md)         | GET    | /api/objectives/{objective_id}/undo_finish | 必要  |
| [目標の開始時間を変更する](README/update-start_date-objective.md) | PUT    | /api/objectives/update_start_date          | 必要  |
| [目標の期限日を変更する](README/update-due_date-objective.md)    | PUT    | /api/objectives/update_due_date            | 必要  |
| [目標をPublicにする](README/share-objective.md)             | POST   | /api/objectives/share                      | 必要  |
| [目標をPrivateにする](README/private-objective.md)          | DELETE | /api/objectives/private/{objective_id}     | 必要  |

### タスク操作
|                                             | メソッド   | URI                                                 | 認証  |
|---------------------------------------------|--------|-----------------------------------------------------|-----|
| [タスクをすべて取得する](README/get-tasks.md)          | GET    | /api/objective/{objective_id}/tasks                 | 必要  |
| [タスクを新規作成する](README/create-task.md)         | POST   | /api/objective/{objective_id}/task/create           | 必要  |
| [タスクのタイトルを変更する](README/edit-task_title.md)  | PUT    | /api/objective/{objective_id}/task/{id}/edit_title  | 必要  |
| [タスクの内容を変更する](README/edit-task_note.md)     | PUT    | /api/objective/{objective_id}/task/{id}/edit_note   | 必要  |
| [タスクを開始する](README/start-task.md)            | GET    | /api/objective/{objective_id}/task/{id}/start       | 必要  |
| [タスクを完了する](README/finish-task.md)           | GET    | /api/objective/{objective_id}/task/{id}/finish      | 必要  |
| [タスクを開始を元に戻す](README/undo_start-task.md)    | GET    | /api/objective/{objective_id}/task/{id}/undo_start  | 必要  |
| [タスクを完了を元に戻す](README/undo_finis-task.md)    | GET    | /api/objective/{objective_id}/task/{id}/undo_finish | 必要  |
| [タスクを1つ削除する](README/delete-task.md)         | DELETE | /api/objective/{objective_id}/task/{id}/delete      | 必要  |
| [タスクの開始日を変更する](README/update-start_date.md) | PUT    | /api/objective/{objective_id}/task/{id}/start       | 必要  |
| [タスクを完了日を変更する](README/update-end_date.md)   | PUT    | /api/objective/{objective_id}/task/{id}/finish      | 必要  |


