### 権限
必要

### エンドポイント
```
GET https://goal-management.com/api/objectives
```


### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |

### 応答
| 名称                | 内容      |
|-------------------|---------|
| `[i][created_at]` | 作成日時    |
| `[i][due_date]` | 期限      |
| `[i][finish_date]` | 終了日時    |
| `[i][id]` | ID      |
| `[i][start_date]` | 開始日時    |
| `[i][status]` | 目標の状況   |
| `[i][title]` | タイトル    |
| `[i][updated_at]` | 更新日時    |
| `[i][user_id]` | ユーザーのID |



### 応答
```js
[
    {
        created_at: "2022-02-14T15:53:54.000000Z",
        due_date: "2022-02-18",
        finish_date: null,
        id: 12,
        start_date: "2022-02-14 00:00:00",
        status: 0,
        title: "title",
        updated_at: "2022-02-14T15:53:54.000000Z",
        user_id: 5
    },
    {
        created_at: "2022-02-14T15:53:54.000000Z",
        due_date: "2022-02-22",
        finish_date: null,
        id: 14,
        start_date: "2022-02-16 00:00:00",
        status: 0,
        title: "title",
        updated_at: "2022-02-16T14:35:54.000000Z",
        user_id: 5
    }
]
```

