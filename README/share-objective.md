### 権限
必要

### エンドポイント
```
POST https://goal-management.com/api/objectives/share
```


### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |
| 本文   | `objective_id` | 対象の目標ID            |

### 応答
| 名称           | 内容          |
|--------------|-------------|
| `created_at` | 作成日時        |
| `updated_at` | 更新日時        |
| `id`         | Share用目標のID |
| `objective_id`    | 目標のID       |

### 応答
```js
{
    created_at: "2022-02-14T15:53:54.000000Z"
    updated_at: "2022-02-14T15:53:54.000000Z"
    id: 3
    objective_id:5
}
```

