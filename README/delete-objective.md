### 権限
必要

### エンドポイント
```
DELETE https://goal-management.com/api/objectives/:objective_id/delete
```


### パラメータ
| 場所   | 名称             | 内容                 |
|------|----------------|--------------------|
| ヘッダー | `X-XSRF-TOKEN` | ログイン時に取得したCSRFトークン |
| パス   | `objective_id` | 対象の目標ID            |

### 応答
| 名称        | 内容        |
|-----------|-----------|
| `message` | 成功時のメッセージ |

### 例
```js
{
    message:"目標を削除しました。"
}
```

