### 権限
必要

### エンドポイント
```
GET https://goal-management.com/api/user
```

### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |


### 応答
| 名称                   | 内容        |
|----------------------|-----------|
| `created_at`         | 作成日時      |
| `email`              | メールアドレス   |
| `email_verified_at`  | （使用せず）    |
| `id`                 | ID        |
| `max_objectives_num` | 目標の作成上限数  |
| `max_tasks_num`      | タスクの作成上限数 |
| `name`               | 名前        |
| `updated_at`         | 更新日時      |


```js
{
    created_at: "2022-02-14T12:44:20.000000Z"
    email: "sample@sample.sample"
    email_verified_at: null
    id: 5
    max_objectives_num: 5
    max_tasks_num: 30
    name: "sample"
    updated_at: "2022-02-14T12:44:20.000000Z"  
}

```
