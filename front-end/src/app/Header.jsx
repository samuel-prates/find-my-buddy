import { useSelector, useDispatch } from "react-redux"
import { Link } from "react-router-dom"
import { setter } from "./redux/TokenSlice"
import {useNavigate} from "react-router-dom"

const Header = () => {
    const token = useSelector((state) => state.reducer?.value.token)
    const dispatch = useDispatch()
    let navigateTo = useNavigate();
    const defaultHeader = {
        Authorization: `Bearer ${token}`
    }
    let logRender;

    const logout = async (e) => {
        e.preventDefault()
        dispatch(setter({}))
        navigateTo('/')
    }
    if (token) {
        logRender = <ul class="right hide-on-med-and-down"><li><Link onClick={logout}>Logout</Link></li></ul>;
    } else {
        logRender = <ul class="right hide-on-med-and-down"><li><Link to={`/signin`}>Sign In</Link></li><li><Link to={`/signup`}>Sign Up</Link></li></ul>;
    }

    return (
        <nav class="nav-extended">
            <div className="nav-wrapper container">
                <Link to={`/`}>Fmb</Link>
                {logRender}
            </div>
        </nav>
    )
}

export default Header