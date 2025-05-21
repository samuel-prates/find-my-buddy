import { useState } from "react"
import { useSelector, useDispatch } from "react-redux"
import { setter } from "./redux/TokenSlice"
import { useNavigate } from "react-router-dom"
import Layout from "./Layout"

const SignIn = () => {
    let navigateTo = useNavigate();
    const token = useSelector((state) => state?.token?.value)
    const dispatch = useDispatch()
    const [email, setLogin] = useState('')
    const [password, setPassword] = useState('')

    const handleSubmit = async (e) => {
        e.preventDefault()
        console.log('form submitted')

        const payload = {
            email,
            password,
        }

        fetch('/api/login', {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.json())
            .then(json => {
                console.log(json)
                if (json?.token) {
                    dispatch(setter(json))
                    navigateTo('/')
                }
            })
            .catch(err => {
                console.error(err)
            })
    }

    return (
        <>
            <Layout>
                <div class="section container">
                    <div class="row">
                        <div class="col s12 m6 offset-m3">
                            <div class="card login-wrapper">
                                <div class="card-content">
                                    <div id="CustomerLoginForm">
                                        <h4 class="center">SignIn</h4>
                                        <form onSubmit={handleSubmit}>
                                            <input type="text" placeholder="Login" value={email} onChange={(e) => setLogin(e.target.value)} />
                                            <input type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)} />
                                            <button type="submit" class="btn-large z-depth-0">Sign In</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </Layout>
        </>
    )
}

export default SignIn