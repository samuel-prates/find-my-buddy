import { useState } from "react"
import Layout from "../Layout";

const CompleteRegister = () => {
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [legal_document, setDocument] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault()

        const payload = {
            name,
            email,
            legal_document,
            password
        }

        fetch('/api/register', {
            method: 'POST',
            body: JSON.stringify(payload),
            headers: { 'Content-Type': 'application/json' }
        })
            .then(response => response.json())
            .then(json => {
                console.log(json)
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
                                        <h4 class="center">Register</h4>
                                        <form onSubmit={handleSubmit}>
                                            <input type="text" placeholder="Name" value={name} onChange={(e) => setName(e.target.value)} />
                                            <input type="text" placeholder="Email" value={email} onChange={(e) => setEmail(e.target.value)} />
                                            <input type="password" placeholder="Password" value={password} onChange={(e) => setPassword(e.target.value)} />
                                            <input type="text" placeholder="CPF/CNPJ" value={legal_document} onChange={(e) => setDocument(e.target.value)} />
                                            <p/>
                                            <button type="submit" class="btn-large z-depth-0">register</button>
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

export default Register