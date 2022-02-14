### 権限
必要

### エンドポイント
```
GET https://goal-management.com/api/user
```


### パラメータ
| 場所  | 名称     | 内容 |
|-----|--------|--|
| 本文  | `name` | UserName　Max:20 |
| 本文  | `email` | UserName　unique |
| 本文  | `password` | UserName　Min:8 |

### 応答
| 名称     | 内容 |
|--------|--|
| `message` | ログアウトしました |

```js
{
    message:'ユーザ登録しました'
}
```
### Error

