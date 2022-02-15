### 権限
必要

### エンドポイント
```
PUT https://goal-management.com/api/api/objectives/update_due_date
```


### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |
| 本文   | `objective_id` | 対象の目標ID            |
| 本文   | `due_date`     | 期限                 |

### 応答
なし

