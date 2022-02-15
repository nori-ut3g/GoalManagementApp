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
| 名称     | 内容      |
|--------|---------|
| `created_at` | 作成日時    |
| `updated_at` | 更新日時    |
| `user_id` | ユーザーのID |

### 応答
```js
{

}
```

