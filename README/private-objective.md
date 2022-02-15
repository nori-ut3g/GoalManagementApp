### 権限
必要

### エンドポイント
```
DELETE https://goal-management.com/api/objectives/private/:objective_id
```


### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |
| 本文   | `objective_id` | 対象の目標ID            |

### 応答
なし
