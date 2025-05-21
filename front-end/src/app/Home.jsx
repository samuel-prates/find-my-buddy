import Layout from "./Layout"
import { useEffect, useState } from "react";
import { useSelector } from "react-redux";
import { Link } from "react-router-dom";

const Home = () => {
    const token = useSelector((state) => state.reducer?.value.token)
    const [users, setUsers] = useState([]);
    const urlValue = '/manager/user/'

    if (token) {
        const defaultHeader = {
            Authorization: `Bearer ${token}`
        }
        const fetchUsers = async () => {
            const response = await fetch('/api/users', {
                method: 'GET',
                headers: { 'Content-Type': 'application/json', ...defaultHeader }
            });
            if (response.status < 400) {
                const body = await response.json();
                setUsers(body.users);
            }
        }
        useEffect(() => {
            fetchUsers();
        }, []);

    }
    return (
        <>
            <Layout>
                <div class="container">
                    {
                        <table class="bordered striped centered highlight responsive-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                {users.map((user) => (
                                    <tr key={user.id}><td>{user.id}</td><td>{user.name}</td><td>{user.email}</td><td><Link to={urlValue+user.id} class="btn-large z-depth-0">Manage</Link></td></tr>
                                ))}
                            </tbody>
                        </table>
                    }
                </div>
            </Layout>
        </>
    )
}

export default Home