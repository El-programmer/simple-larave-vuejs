import Login from './components/Login'
import Register from './components/Register'
import Post from './components/Post'
import Category from './components/Category'


const routes = [
    {path:'/login' ,component:Login,name:'Login to Posts'},
    {path:'/register',component:Register,name:'Register new user'},
    {path:'/category',component:Category,name:' category'},
    {path:'/post',component:Post,name:' Posts'}
]
export default routes 